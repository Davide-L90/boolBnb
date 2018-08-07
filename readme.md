# BoolBnb

### Guidelines

https://docs.google.com/document/d/1rTGRQXWqYZAj2SqY8iQ5vgDgqYtVYMhtrqCcfLcFWTE/edit

### Installation

```sh
$ git clone https://github.com/alelax/boolBnb.git
$ composer install
$ npm install
$ mv .env.example .env
```

Create new Database, and insert db data in .env file as follow:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Or import DB bool.sql from repo, and insert its data in .env file as follow:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bool
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Next generate your key:

```sh
$ php artisan key:generate
```

Create a symlink form storage dir to public dir to link the images:
```sh
$ php artisan storage:link
```

last, run the migrations

```sh
$ php artisan migrate
```

### Usage

The credentials to log in are:

- email: admin.admin@gmail.com
- pw: laravel

