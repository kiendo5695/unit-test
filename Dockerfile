FROM php:8.1-fpm

WORKDIR /var/www/html

#COPY ./.ssh/id_rsa /root/.ssh/id_rsa
#COPY ./.ssh/id_rsa.pub /root/.ssh/id_rsa.pub

RUN apt-get update && apt-get install -y libzip-dev && \
                      apt-get install -y git && \
                      apt-get install -y nano && \
                      apt-get install -y bash && \
                      apt-get install -y openssh-client
ENV ACCEPT_EULA=Y
# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install apt-utils libxml2-dev gnupg apt-transport-https zip libzip-dev \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql
#RUN docker-php-ext-install unzip
#RUN docker-php-ext-install gd


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN alias composer='php composer.phar'

#RUN chmod 600 ~/.ssh/id_rsa

EXPOSE 9000
