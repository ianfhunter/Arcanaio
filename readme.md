# Arcana.io 5E Database & Tools

Arcana.io is a web application made for 5E players and GMs.


## Security Vulnerabilities

If you discover a security vulnerability within Arcana.io, please send an e-mail to Odin at odin@arcana.io. All security vulnerabilities will be promptly addressed.

## License

The Arcana.io is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT). For information regarding third party packages and tools, please refer to their own individual licenses. 

## Setup

### PHP

- Install PHP
- Ensure your php.ini file has "extension=php_fileinfo.dll" without a leading ';'
- The same for php_curl.dll

- Install Composer
> https://getcomposer.org/download/

- Use Composer to install Dependencies for PHP
> composer install

- Set Composer to install Laravel
> composer global require "laravel/installer"

### Node

- Install NodeJS & NPM (Node Package Manager)
> sudo apt-get install node npm

- Install Gulp build system for node
> npm install gulp

- Install node library dependencies using gulp.
> Navigate to ArcanaIO's root directory and run "npm install"

- Set up enviroment 
> Copy .env.example to .env

- Sign up to algolia to get an APP ID, APP KEY and APP PRIVATE KEY. Fill these out in the .env
> www.algolia.com

> php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"

### Start Server

- Install Redis
> https://github.com/rgl/redis/downloads

- Copy redis-dist.conf into the Redis folder (Program Files/Redis on Windows)

- Start Redis running
> (in a new terminal) net start redis

- Generate an app key
> php artisan key:generate ; php artisan config:clear ; php artisan config:cache

- Start the server
> php artisan serve