FROM php:8.0-fpm

# Install modules
RUN apt-get update && apt-get install -y \
	default-mysql-client \
	git \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install opcache

CMD ["php-fpm"]
