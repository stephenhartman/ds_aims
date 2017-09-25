<p align="center"><img src="http://mediaprocessor.websimages.com/fit/1920x1920/www.depaulschool.com/Large DePaul Lion Head Silhouette Facing Right.png" width="71px" height="89px"></p>

## About DSAIMS

This is a client project for the DePaul School of Jacksonville.

### Group Members

- [Kevin Bell](https://github.com/jawsofdoom)
- [Andrew Greer](https://github.com/Initech9)
- [Stephen Hartman](https://github.com/stephenhartman)
- [Lindsey Wanta](https://github.com/lindseywanta)


## Laravel Documentation

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Installation

### Mac OSX

1. Clone [the repository](https://github.com/stephenhartman/ds_aims) into project folder of choice

`git clone https://github.com/stephenhartman/ds_aims.git`

2. Install [PHP](http://php.net/)

- Install [Homebrew](https://github.com/Homebrew/brew)
`brew tap homebrew/homebrew-php`

3. Install [Composer](https://getcomposer.org/download/) Dependency Manager

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

4. Download [Laravel](https://laravel.com/) using Composer

`composer global require "laravel/installer"`

- Add $HOME/.composer/vendor/bin to $PATH in terminal rc file (e.g. ~/.bashrc)

5. Install npm in project folder

```
brew install npm
brew install node
```

6. Install [Laravel Mix](https://laravel.com/docs/5.4/mix) in project folder

`npm install`

`npm run watch` will monitor all relevant files for changes to compile (css and js)

7. Setup Mysql database

- Download [mysql](https://www.mysql.com/downloads/) or use command line `brew install mysql`
- Start daemon `mysqld` or use GUI tool to start the server on localhost
- Log into mysql `mysql -u root`
- Create the database `mysql> create database vol_db;`
- Make sure you create the user, example `mysql> CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';`
- Grant permissions for that user `mysql> GRANT ALL PRIVILEGES ON vol_db . * TO 'newuser'@'localhost';`
    - The first variable after `ON` is the database and the second variable after `.` is the table, * for all tables.
- Reset permissions `mysql> FLUSH PRIVILEGES;`

8. Migrate and seed database from shell
```
php artisan migrate
php artisan db:seed
```
