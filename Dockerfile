FROM docker.io/nginx:alpine
WORKDIR /usr/share/nginx/html
RUN apk update && \
    apk add --no-cache curl
#RUN apk add apache2-ssl apache2

#RUN apk add php$phpverx-apache2 

RUN apk add php-fpm 

COPY ssl/nginx-selfsigned.crt /etc/ssl/certs/nginx-selfsigned.crt
COPY ssl/nginx-selfsigned.key /etc/ssl/private/nginx-selfsigned.key
COPY ssl/ssl.conf /etc/nginx/conf.d/ssl.conf
COPY ./data/ .
EXPOSE 80
EXPOSE 443
CMD ["nginx", "-g", "daemon off;"]
