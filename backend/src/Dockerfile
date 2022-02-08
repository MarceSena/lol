FROM php:8.0.1-apache-buster

RUN a2enmod rewrite

RUN a2enmod headers

RUN docker-php-ext-install pdo pdo_mysql bcmath opcache


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY composer.json composer.json

RUN composer dump-autoload --no-scripts --no-dev --optimize

RUN chmod -R 755 /var/www/html/ 

