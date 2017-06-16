Tech'IT easy
============

Server Requirements
-------------------

* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* MySQL
* WAMP for windows users

Installation
=============

Clone the repository
```
$ https://github.com/herosion/techiteasy.git
```

Run `composer install` to setup all vendors

Next you must ensure that NodeJS is installed on your machine

```
$ node -v
```
If not you can download it [here](https://nodejs.org/en/download/) (for windows users) 

Install Gulp

```
$ npm install --global gulp
```

And run

```
$ npm install
```

Then you can run Elixir

```
// Run all tasks...
$ gulp

// Run all tasks and minify all CSS and JavaScript...
$ gulp --production
```

Configuration
=============

Check if `.env` already exists

If not, create them from the `.env.example` files 
```
$ cp .env.example .env
```

### Configure App

Set the application debug mode to true in `.env`

And set your local project base url too
```
APP_DEBUG=true
```

### Configure Database

Create your local database

WARNING : for windows user launch MySQLconsole from Wamp

```
#!sql
mysql> CREATE DATABASE `techiteasy`;
```

Set mysql connection parameters in `.env` with your localhost database informations
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=techiteasy
DB_USERNAME=root
DB_PASSWORD=root (or none)
```
Then run the database migration with the command `php artisan migrate`

Last step run the seed of the database with `php artisan db:seed`

Informations
-------------

### Good practices

This is **VERY IMPORTANT**, please read this before start to work on the project :

* [PSR-0 - Autoloading standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* [PSR-1 - Basic coding standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
* [PSR-2 - Coding style guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [PSR-4 - Autoloader](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)

**TL;DR ???** Just take a look at **PSR-1** and **PSR-2**...

#### GIT

Read : [GitFlow](https://fr.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow)

##### Branch naming

Every new branch must start with it type. For example `my-new-super-post-form` isn't a good name, `feature/super-post-form` is better. It's most cleaner and practical to make filters.

List all `test` branches :
```
$ git branch --list "test/*"
```

### Default backoffice admin access

login : `admin`

password : `toor`

##About Laravel

### Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

### Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

#### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


#### Command control temporary

use Git Bash

```
$ cd C:/wamp/www/techiteasy
```

```
$ git checkout master
```
move on branches

```
$ git pull origin master
```
update branches

when somebody write on database we need to migrate PHP like :

```
$ php artisan migrate
```
