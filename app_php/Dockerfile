FROM php:7.3-apache

# Actualizar el sistema y habilitar módulos necesarios
RUN apt-get update && \
    a2enmod rewrite && \
    apt-get install -y libpq-dev

# Instalar extensiones PDO y el controlador PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Reiniciar el servidor Apache para aplicar los cambios
RUN service apache2 restart
