FROM php:apache


RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt update && apt install -y git zip

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp 
RUN docker-php-ext-install gmp

RUN composer require sendgrid/sendgrid
RUN composer require minishlink/web-push

RUN apt install -y iputils-ping

RUN apt install -y python3 python3-venv libaugeas0
RUN python3 -m venv /opt/certbot/
RUN /opt/certbot/bin/pip install --upgrade pip
RUN /opt/certbot/bin/pip install certbot certbot-apache

RUN ln -s /opt/certbot/bin/certbot /usr/bin/certbot
RUN certbot --apache --non-interactive --agree-tos -m stearns.josiah@gmail.com --domains falconclean.app

RUN a2enmod rewrite

RUN echo "0 0,12 * * * root /opt/certbot/bin/python -c 'import random; import time; time.sleep(random.random() * 3600)' && certbot renew -q" | tee -a /etc/crontab > /dev/null