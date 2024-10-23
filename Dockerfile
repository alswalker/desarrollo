# Usa la imagen de PHP como base
FROM php:7.2-fpm

# Instalar las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Instalar Phalcon
RUN apt-get update && apt-get install -y \
    git \
    && git clone --branch 4.0 https://github.com/phalcon/cphalcon.git /tmp/cphalcon \
    && cd /tmp/cphalcon/build \
    && ./install \
    && docker-php-ext-enable phalcon

# Establecer el directorio de trabajo
WORKDIR /app

# Copiar el código fuente de la aplicación
COPY . .

# Instalar dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install

# Exponer el puerto en el que la aplicación escucha
EXPOSE 80

# Comando para iniciar la aplicación
CMD ["php-fpm"]
