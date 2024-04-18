 # Your custom build here
FROM openswoole/swoole:php8.3-dev

RUN docker-php-ext-install pdo_pgsql