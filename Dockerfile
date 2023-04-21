FROM composer:latest AS composer
FROM bref/php-81 AS build

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY skeleton/composer.json composer.lock /var/task/

RUN composer check-platform-reqs && composer install --no-dev --prefer-dist --optimize-autoloader
RUN rm -f composer.phar
COPY skeleton /var/task

FROM bref/php-81

COPY --from=build /var/task /var/task

CMD [ "vendor/simplia/integration/handler.php" ]
