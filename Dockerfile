FROM alpine:latest

# Instalar nginx + php + extensiones necesarias
RUN apk update && \
    apk add nginx php-fpm php-cli php-mysqli php-json php-openssl php-curl php-session php-zip

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
CMD ["sh", "-c", "php-fpm83 -F & nginx -g 'daemon off;'"]
