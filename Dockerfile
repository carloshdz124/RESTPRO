# Usa una imagen base con PHP y Apache
FROM php:8.2-apache

# Instala dependencias adicionales si es necesario
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expon el puerto 80
EXPOSE 80
