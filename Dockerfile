FROM wordpress:7.0.2-php8.2-apache

COPY src/plugins/ /var/www/html/wp-content/plugins/
COPY src/themes/ /var/www/html/wp-content/themes/