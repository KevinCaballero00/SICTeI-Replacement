FROM alpine:latest

# Instalar nginx + PHP 8.2 + extensiones necesarias
RUN apk update && apk add --no-cache \
    nginx \
    php82 \
    php82-fpm \
    php82-mysqli \
    php82-json \
    php82-openssl \
    php82-curl \
    php82-session \
    php82-zip

# Crear carpetas necesarias para nginx
RUN mkdir -p /run/nginx

# Copiar proyecto dentro del contenedor
COPY . /var/www/html

# Copiar configuración de nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Establecer permisos para uploads y php
RUN chown -R nginx:nginx /var/www/html

EXPOSE 80

# Iniciar php-fpm82 y nginx
CMD ["sh", "-c", "php-fpm82 -F & nginx -g 'daemon off;'"]
