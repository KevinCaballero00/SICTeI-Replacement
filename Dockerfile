FROM alpine:latest

# Instalar nginx + php83 + extensiones necesarias
RUN apk update && \
    apk add nginx php83 php83-fpm php83-mysqli php83-json php83-openssl php83-curl php83-session php83-zip

# Crear carpetas necesarias para nginx
RUN mkdir -p /run/nginx

# Copiar TODO tu proyecto dentro del contenedor
COPY . /var/www/html

# Copiar configuración de nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Establecer permisos correctos
RUN chown -R nginx:nginx /var/www/html

EXPOSE 80

# Iniciar php-fpm83 y nginx correctamente
CMD ["sh", "-c", "php-fpm83 -F & nginx -g 'daemon off;'"]
