FROM php:8.0-apache

# Actualizar el sistema y habilitar módulos necesarios
RUN apt-get update && \
    a2enmod rewrite && \
    apt-get install -y libpq-dev

# Instalar extensiones PDO y el controlador PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Reiniciar el servidor Apache para aplicar los cambios
RUN service apache2 restart

RUN pecl install xdebug && docker-php-ext-enable xdebug \
    && echo "\
xdebug.mode = debug \n\
xdebug.start_with_request = yes \n\
xdebug.client_host = 172.17.0.1 \n\
xdebug.client_port = 9000 \n\
" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20200930/xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini