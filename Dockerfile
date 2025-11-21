FROM alpine:latest

RUN apk update && \
    apk add nginx php83 php83-fpm php83-mysqli php83-json php83-openssl php83-curl php83-session php83-zip

RUN mkdir -p /run/nginx

# Copiar el proyecto tal cual, manteniendo /data/
COPY . /var/www/html/

# Ajustar permisos
RUN chown -R nginx:nginx /var/www/html

EXPOSE 80

CMD ["sh", "-c", "php-fpm83 -F & nginx -g 'daemon off;'"]

