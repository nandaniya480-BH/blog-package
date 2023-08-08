<?php

namespace Nandaniya480\Blog\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Nandaniya480\Blog\Models\Blog;
use Nandaniya480\Blog\Response;

class BlogController
{
    public function index()
    {
        $blog = Blog::all();
        return Response::sendSuccess('Blog List!', true, $blog, HttpResponse::HTTP_OK);
    }

    public function slug($title, $id = 0)
    {
        $slug = Str::slug($title);

        $allSlugs = Blog::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();

        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;

            if (!Blog::where('id', '!=', $id)->whereSlug($newSlug)->exists()) {
                return $newSlug;
            }
        }
    }

    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::user()->id ?? 1, 'slug' => $this->slug($request->title)]);

        $validator = Validator::make($request->all(), [
            'title' =>  'required',
            'slug' =>  'required',
            'body' =>  'required',
            'user_id'  =>  'required'
        ]);

        if ($validator->fails()) {
            return Response::sendError('Validation Error', $validator->messages(), HttpResponse::HTTP_BAD_REQUEST);
        }

        $blog =  Blog::create($validator->validated());
        return Response::sendSuccess('Blog Created!', true, $blog, HttpResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {

        $blog =  Blog::find($id);
        if (!$blog) {
            return Response::sendError('Not found', [], HttpResponse::HTTP_NOT_FOUND);
        }

        $request->request->add(['slug' => $this->slug($request->title, $id)]);
        $validator = Validator::make($request->all(), [
            'title' =>  ['required'],
            'slug' =>  ['required'],
            'body' =>  ['required'],
        ]);

        if ($validator->fails()) {
            return Response::sendError('Validation Error', $validator->messages(), HttpResponse::HTTP_BAD_REQUEST);
        }


        $blog->update($validator->validated());

        return response()->json(['status' => 200, 'message' => 'Blog Updated!', 'data' => $blog]);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        return Response::sendSuccess('Blog Detail!', true, $blog, HttpResponse::HTTP_OK);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->update(['status' => false]);
            return Response::sendSuccess('Blog Deleted!', true, [], HttpResponse::HTTP_OK);
        } else {
            return Response::sendError('Not found', [], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
