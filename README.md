# Peroxide: API-Skeleton
API skeleton: Built on top of Slim and OpenSwoole, our API skeleton is designed for microservices projects, 
prioritizing both performance and simplicity.

# How to install
Using *composer* to install the skeleton:
```bash
# install using openswoole binaries
$  docker run \
        -u 1000:1000 \
        -w /var/www \
        -v .:/var/www --rm \
         openswoole/swoole:php8.3-dev \
         create-project peroxide/api-skeleton <your_project_dir>
```

Or

```bash
         
$ composer create-project \
      --ignore-platform-reqs \
      peroxide/api-skeleton <your_project_dir>
```
**Please note**: Running Composer without the **--ignore-platform-reqs** flag may result in errors if you haven't 
installed the OpenSwoole PHP extension.
# Setup
Create your local **.env** file
```bash
$ cp .env.example .env
```

---

To start the local server, you'll need **Docker** and **Compose** up and running under your system user. No fancy 
commands needed, just make sure Docker and Compose are good to go.

To run as *docker compose*
```bash
$ docker compose up -d
```

# Testing
Health check route

```bash
$ curl http://localhost:8085/check-health
```

# Create your code
#### Router
Routes can be declared on config/routes.php, you are free to compose your route files like
the example:
```php
// config/routes.php file
return (function (App $app) {
    // Activate Global CORS
    $app = (new GlobalCors($app))->getDecorated();

    $app->get('/health-check', HealthCheckController::class);

    // Your routes definitions here
    // You can config route in your preferred directory
    $app = require __DIR__ . '/../app/Products/routes.php';
    $app = require __DIR__ . '/../app/Users/routes.php';
    $app = require __DIR__ . '/../app/Sales/routes.php';

    // Or you can config group routes here:
    $app->group('/cart', function (Slim\Routing\RouteCollectorProxy $group) {
        $group->get('/products', YourDependencyReference::class);
        // ...
    })->add(new AMiddlewareAction());

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: make sure this route is defined last
     */
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        throw new HttpNotFoundException($request);
    });

    return $app;
})($app);
```

For more details read Slim 4 Routes resolution page:

https://www.slimframework.com/docs/v4/objects/routing.html

Obs: All routes are managed by methods specified in the router configuration, which utilize callable classes with the 
'__invoke' method, simple methods, or callable functions.

---

#### Our Container
We've developed our straightforward container component, named **peroxide/container**. With it, injecting dependencies 
into your classes becomes a breeze: Controllers, UseCases, Commands, DTOs, and Domains in a declarative manner. 
For further insights, check out the documentation:

https://github.com/Peroxide-PHP/peroxide-container

Container resolution follows the **PSR-11** standard, offering the flexibility to adjust the container mechanism 
according to your preferences, you can even swap it out entirely if needed.

---
#### Migrations
We're offering a migration component called Phinx, which is a standalone library for implementing migrations without 
being tied to any specific frameworks.

Here how to use it:
```sh
# outside the container
# read about phinx
./exec composer phinx

# creating a migration
./exec composer phinx create YourMigrationActionInCamelCase

# a file like database/migrations/20240418001416_your_migration_action_in_camel_case.php
# will be created

# After you migration file config run
./exec composer migrate

# And your migration will be executed

# To undo the last migration just run
./exec composer rollback
```

Example of migration class:
```php
final class CreateUsersTableTest extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table
            ->addColumn('email', 'string', ['limit' => 130])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->create();
    }
}
```

For more details about phinx read:
https://book.cakephp.org/phinx/0/en/migrations.html

---
#### Seeders
Session under construction...

# Quality tools
Code sniffer
```bash
./exec composer sniff
```

CS Fixer
```bash
./exec composer fix
```

Tests with PHPUnit
```bash
./exec composer test
```

PHPStan
```bash
./exec composer stan
```

Mess Detector
```bash
./exec composer md
```

# Performance benchmarks
Coming soon...

# Attention!
This skeleton server runs on the OpenSwoole runtime, enabling executions through coroutines. 

It's crucial to be mindful of socket communications, using PDO with Postgres can block the event loop, 
while MySQL with PDO is compatible (swoole handles communication for you). 

For Postgres, consider utilizing the Postgres Client instead. Be diligent in vetting any other communication methods 
before implementation to preempt any unforeseen issues down the line.

For more informations about blocking event loop please check the documents: https://openswoole.com/

# Suggestions or PR's
Feel free to fork the project and submit a pull request to the develop branch. We welcome any suggestions or 
collaborations you have to offer!