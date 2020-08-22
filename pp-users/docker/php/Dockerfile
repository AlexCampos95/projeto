FROM php:7.3.21-fpm-alpine3.12

ENV XDEBUG_INI_FILE=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install -o -f redis-4.2.0 \
    && pecl install -o -f xdebug-2.7.0

COPY --from=composer /usr/bin/composer /usr/bin/

RUN docker-php-ext-enable redis xdebug

RUN docker-php-ext-enable xdebug \
    && echo "xdebug.remote_port=10000" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.coverage_enable=0" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_enable=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_connect_back=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_log=/tmp/xdebug.log" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_autostart=true" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_host=webserver" >> ${XDEBUG_INI_FILE} \
    && echo "variables_order=GPCS" >> /usr/local/etc/php/conf.d/variables_order.ini
