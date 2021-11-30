#!/bin/bash
# Set permissions to storage and bootstrap cache
mkdir -p /var/www/develop.dint
sudo chown ubuntu:ubuntu /var/www/develop.dint
cd /var/www/develop.dint
# #
# # Run composer
wget 'https://getcomposer.org/download/latest-stable/composer.phar'
chmod +x composer.phar
./composer.phar install # --no-ansi --no-dev --no-suggest --no-interaction --no-progress --prefer-dist --no-scripts


if [[ -d /var/www/develop.dint/storage ]]; then sudo chmod -R 0777 /var/www/develop.dint/storage; fi

if [[ -d /var/www/develop.dint/bootstrap/cache ]]; then sudo chmod -R 0777 /var/www/develop.dint/bootstrap/cache; fi

if [[ -d /var/www/develop.dint/vendor/ ]]; then sudo chmod -R 0777 /var/www/develop.dint/vendor/; fi

sudo chown -R ubuntu:www-data /var/www/develop.dint
# #
# # Run artisan commands
if [[ -d /var/www/develop.dint/artisan ]]; then php artisan migrate; fi