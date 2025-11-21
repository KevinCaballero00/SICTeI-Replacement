FROM alpine:3.19

RUN apk update && \
    apk add --no-cache nginx supervisor \
    php82 php82-fpm php82-mysqli php82-json php82-openssl \
    php82-curl php82-session php82-zip php82-fileinfo php82-xml

RUN mkdir -p /run/nginx

COPY . /var/www/html/

RUN chown -R nginx:nginx /var/www/html

# ============== SUPERVISOR ==============
COPY supervisor.conf /etc/supervisord.conf

ENV PORT=8080
EXPOSE 8080

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
