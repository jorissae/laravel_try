FROM php:8.2-apache

WORKDIR /var/www/

RUN mkdir -p /usr/local/nvm
ENV NVM_DIR /usr/local/nvm

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN apt-get update \
    && apt-get install -y --no-install-recommends locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen


RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer
RUN a2enmod rewrite
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring gd xsl
RUN pecl install apcu && docker-php-ext-enable apcu

#RUN bash nvm install 20
COPY ./entrypoint.sh /entrypoint.sh
COPY . /var/www/
COPY ./php/vhosts/default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./php/php.ini /usr/local/etc/php/

RUN curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash
#ENTRYPOINT ["/entrypoint.sh"]
#RUN cd project && npm run build


