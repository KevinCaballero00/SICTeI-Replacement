FROM alpine:latest

# Instalar nginx + php + extensiones necesarias
RUN apk update && \
    apk add nginx php81 php81-fpm php81-mysqli php81-json php81-openssl php81-curl php81-session php81-zip php-mysqli php-json php-openssl php-curl php-session php-zip

# Crear carpetas necesarias para nginx
RUN mkdir -p /run/nginx

# Copiar TODO tu proyecto dentro del contenedor
COPY . /var/www/html

# Copiar configuración de nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Establecer permisos para uploads y php
RUN chown -R nginx:nginx /var/www/html

EXPOSE 80

# Iniciar php-fpm83 y nginx correctamente
CMD ["sh", "-c", "php-fpm82 -F & nginx -g 'daemon off;'"]


