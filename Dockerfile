FROM alpine:3.19

RUN apk update && \
    apk add --no-cache nginx supervisor \
    php82 php82-fpm php82-mysqli php82-json php82-openssl \
    php82-curl php82-session php82-zip php82-fileinfo php82-xml

RUN mkdir -p /run/nginx /run/php-fpm /var/lib/php/sessions && \
    chmod 777 /var/lib/php/sessions

COPY . /var/www/html/

# Dar permisos al script
RUN chmod +x /var/www/html/start-php-fpm.sh

RUN chown -R nginx:nginx /var/www/html && \
    chown -R nginx:nginx /run/php-fpm

RUN sed -i 's/listen = \/run\/php-fpm\/php-fpm82.sock/listen = 127.0.0.1:9000/' /etc/php82/php-fpm.d/www.conf && \
    sed -i 's/;listen.owner = nginx/listen.owner = nginx/' /etc/php82/php-fpm.d/www.conf && \
    sed -i 's/;listen.group = nginx/listen.group = nginx/' /etc/php82/php-fpm.d/www.conf && \
    sed -i 's/;clear_env = no/clear_env = no/' /etc/php82/php-fpm.d/www.conf

COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisor.conf /etc/supervisord.conf

ENV PORT=8080
EXPOSE 8080

CMD ["supervisord", "-c", "/etc/supervisord.conf"]