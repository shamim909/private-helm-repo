FROM nginx:1.19.2-alpine
MAINTAINER Md Shamimuddin <shamim909@hotmail.com>
RUN apk add --no-cache --virtual .build-deps \
    php php-fpm supervisor curl bash openssl
#delete all the default configuration files
#RUN rm /etc/nginx/conf.d/default.conf  && \
#    rm /etc/nginx/mime.types /etc/nginx/nginx.conf
RUN curl https://raw.githubusercontent.com/helm/helm/master/scripts/get-helm-3 | bash
#COPY all the required nginx config files
COPY config/nginx.conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY config/nginx.conf.d/mime.types /etc/nginx/mime.types
COPY config/nginx.conf.d/nginx.conf /etc/nginx/nginx.conf

#Copy all the required php-fpm configs
COPY config/php-fpm.conf.d/php.ini /etc/php7/php.ini
COPY config/php-fpm.conf.d/fpm-pool.conf /etc/php7/conf.d/www.conf
COPY config/php-fpm.conf.d/php-fpm.conf /etc/php7/php-fpm.conf

#www root folder
RUN mkdir -p /var/www/nginx/tit-helm-repo
COPY index.php /var/www/nginx/tit-helm-repo/index.php

#copy htpasswd accessfile
COPY config/nginx.conf.d/.htpasswd  /etc/nginx/conf.d/.htpasswd



COPY config/supervisord.conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf


CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:80/fpm-ping  
