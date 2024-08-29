# Todos

> Todos website with content retrieving from [prismic.io](https://dummyjson.com/docs/todos#todos-update)

This project runs with Laravel version 11.9.

## Getting started

Assuming you've already installed on your machine: PHP (>= 8.2.0), [Laravel](https://laravel.com), [Composer](https://getcomposer.org) and [Node.js](https://nodejs.org).
# clone
git clone https://github.com/RahmaAlNssar/Todos.git
``` bash
# install dependencies
composer install
npm install

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate

# build CSS and JS assets
npm run dev
# or, if you prefer minified files
npm run prod
```

Then launch the server:

``` bash
php artisan serve
```

The Todos project is now up and running! Access it at http://localhost:8000.

## License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) file for details.
