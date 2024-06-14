ARG BUILD_PHP_VERSION

FROM yiisoftware/yii2-php:${BUILD_PHP_VERSION}-apache

ARG BUILD_PHP_VERSION

ENV INSIDE_DOCKER=1

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

# enable xdebug
RUN docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
