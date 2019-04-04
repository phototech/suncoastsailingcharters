#
# Builder
#
FROM davidbarratt/drupal:8 as service

ENV COMPOSER_ALLOW_SUPERUSER 1

# install the PHP extensions we need
RUN set -ex \
	&& buildDeps=' \
		libjpeg62-turbo-dev \
		libpng-dev \
		libpq-dev \
    libfreetype6-dev \
	' \
	&& apt-get update && apt-get install -y --no-install-recommends $buildDeps && rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-configure gd \
		--with-jpeg-dir=/usr \
		--with-png-dir=/usr \
    --with-freetype-dir=/usr \
	&& docker-php-ext-install -j "$(nproc)" gd exif \
	&& apt-get purge -y --auto-remove $buildDeps

COPY --from=composer:1.7 /usr/bin/composer /usr/bin/composer

COPY ./ /var/www

RUN composer --no-dev install -d /var/www

#
# Builder
#
FROM node:lts as builder

# Dependencies
RUN apt-get update && apt-get install -y \
		unzip \
	--no-install-recommends && rm -r /var/lib/apt/lists/*

COPY --from=service /var/www /app

# Need the Envato Token to download the HTML Template.
ARG NPM_CONFIG_ENVATO_TOKEN

WORKDIR /app/html/themes/contrib/sailor

RUN chmod +x ./bin/download \
    && npm install --unsafe-perm --production

#
# Service
#
FROM service

COPY --from=builder /app /var/www

ENV PATH="/var/www/vendor/bin:${PATH}"

RUN mkdir -p /var/www/tmp \
  && mkdir -p /var/www/html/sites/default/files

# Set the permissions.
RUN chown -R www-data:www-data /var/www/html/sites/default/files \
  && chown -R www-data:www-data /var/www/config \
  && chown -R www-data:www-data /var/www/tmp
