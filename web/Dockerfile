FROM php:7.4-apache

RUN docker-php-ext-install \
  pdo_mysql \
  && a2enmod \
  rewrite \
  && service apache2 restart \
  && apt update \
  && apt install  apt-utils -y\
  && apt install redis-server -y \
  && apt autoremove -y \
  && service redis-server restart