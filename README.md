# PHP Note

A CRUD Blogging Application to learn PHP and Symfony following Traversty Media's 'Up and Running with Symfony 4' series on Youtube.

Part 1: Setup, Controller, Twig => https://www.youtube.com/watch?v=t5ZedKnWX9E 

Part 2: Database and Doctrine ORM => https://www.youtube.com/watch?v=kfiKn5c9l84

Part 3: CRUD => https://www.youtube.com/watch?v=WVeE4SXIOwA

This application uses:

* PHP 7
* Symfony 5 (Framework)
* Doctrine (Database Manager, ORM)


## Up and Running

```
# Start the MySQL Database:
$ docker-compose up -d

$ cd app

app$ ./bin/composer.phar install
app$ ./bin/symfony server:start
```

## Database Migrations

ORM and Database stuff is managed by `doctrine`.

#### Create an Entity (Model)
```
app$ php bin/console make:entity NAME
app$ php bin/console make:entity Article
```

#### Migrate the database changes

```
app$ php bin/console doctrine:migrations:diff
app$ php bin/console doctrine:migrations:migrate
```

## Helpful Links

[Symfony Docs](https://symfony.com/doc/current/index.html)

[BootSwatch](https://bootswatch.com) => Ready to use Bootstrap Themes

