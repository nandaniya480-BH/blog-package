# Create Package 

1. Make a directory in the package folder in Laravel Project using the following command: 

   ```
   mkdir -p packages/<author name>/<package name>/src
   ```

2. To initialize a new Laravel custom package development, move to the directory on terminal with the following command: 

   ```
   cd packages/<author name>/<package name>
   ```

   Then run: 

   ```
   composer init
   ```

   Add only the package folder in a new git repository.

3. Basic folder structure of the package: 

   ```
   author name
   ->package name
    ->src
     ->Controllers
      ->your controller 
     ->Database
      ->migration				
     ->Models
      ->your models
     ->Providers
      ->base service Provider class
     ->resources
      ->all view files
     ->routes
      ->web.php
    ->composer.json
    ->test
   ```

4. For local development, add the following line in Project's composer.json file: 

   ```
   "<author name>\\<package name>\\": "packages/<author name>/<package name>/src/"
   ```

   And run: 

   ```
   composer dump-autoload
   ```

5. Publish the package and push it to the repository.

6. Add it to packagist.org.

7. After adding the package, we can add it to any other Project with our composer require command. For example: 

   ```
   composer require nandaniya480/blog
   ```

   If you did not add any version or tag to your repo, you need to add the branch while requiring it. For example: 

   ```
   composer require nandaniya480/blog:dev-main
   ```

Demo files:

- Example file for Composer.json

  ```
  {                                       
      "name": "<author name>/<package name>",
      "description": "Package description", 
      "type": "package",
      "license": "MIT",
      "authors": [
          {
              "name": "Author Name"
          }
      ],
      "require": {
          "package": "as per requirement"
      },
      "require-dev": {
          "requirement which need only in development"
      },
      "autoload": {
          "psr-4": {
              "App\\": "app/",
              "<author name>\\<package name>\\": "src/",
              "<author name>\\<package name>\\Tests\\": "tests/"
          }
      },
      "extra": {
          "laravel": {
              "providers": [
                  "<author name>\\<package name>\\Providers\\ServiceProvider Name"
              ]
          }
      },
      "minimum-stability": "stable",
      "prefer-stable": true
  }
  ```

- Base Service Provider class

  ```
  <?php
  namespace <author name>\<package name>\Providers;
  use Illuminate\Support\ServiceProvider;
  class BaseServiceProvider extends ServiceProvider
  {
      public function boot()
      {
          $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
          $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
          $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Prefix for access view [Blog]');  // for example (Blog::home.index)
      }
  }
  ```

Important links:

- https://youtube.com/playlist?list=PLpzy7FIRqpGBQ_aqz_hXDBch1aAA-lmgu (YouTube series)
- https://github.com/vicgon
