<?php

namespace Nandaniya480\Blog;

class Response
{
    public static function sendSuccess($message, $status, $result, $statusCode)
    {
        $response = [
            'message' => $message,
            'status' => $status,
            'data'    => $result
        ];
        return response()->json($response, $statusCode);
    }

    public static function sendError($message, $errorMessages = [], $statusCode)
    {
        $response = [
            'message' => $message,
            'status' => false,
            'error_code' => $statusCode,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $statusCode);
    }
}
