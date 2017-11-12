#
# Builder
#

FROM composer as composer

COPY ./ /app

RUN composer --no-dev install

#
# Builder
#
FROM node as builder

# Dependencies
RUN apt-get update && apt-get install -y \
		unzip \
	--no-install-recommends && rm -r /var/lib/apt/lists/*

COPY --from=composer /app /app

# Need the Envato Token to download the HTML Template.
ARG NPM_CONFIG_ENVATO_TOKEN

WORKDIR /app/html/themes/contrib/sailor

RUN npm install --unsafe-perm --production

#
# Service
#
FROM drupal:8-apache

# Dependencies
RUN apt-get update && apt-get install -y \
		mysql-client \
	--no-install-recommends && rm -r /var/lib/apt/lists/*

RUN a2enmod env

COPY --from=builder /app /var/www

# Set the permissions.
RUN chown -R www-data:www-data /var/www/html/sites/default/files
