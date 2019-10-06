FROM wordpress:5.0-php7.3-apache

RUN docker-php-ext-install exif

RUN apt-get update && apt-get install mysql-client

# set up wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp
