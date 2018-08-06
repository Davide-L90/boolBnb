# BoolBnb

### Installation

```sh
$ git clone https://github.com/alelax/boolBnb.git
$ composer install
$ npm install
$ mv .env.example .env
```

Create new Database, and insert db data in .env file as follow:

```sh
$ DB_CONNECTION=mysql
$ DB_HOST=127.0.0.1
$ DB_PORT=3306
$ DB_DATABASE=database_name
$ DB_USERNAME=your_user
$ DB_PASSWORD=your_password
```

Next generate your key:

```sh
$ php artisan generate:key
```

Create a symlink form storage dir to public dir to link the images:
```sh
$ php artisan storage:link
```

last, run the migrations

```sh
$ php artisan migrate
```


