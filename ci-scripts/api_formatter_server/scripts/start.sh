#!/usr/bin/env bash
# additional operations

ASSETS_DIR=/usr/local/bin
python ${ASSETS_DIR}/set_user_ids.py

version_to_deploy=$(date -d "2013-04-06" "+%s%N" | cut -b1-13)
echo "Deploying version: ${version_to_deploy}"


echo "copy virtualhosts"
cp ${ASSETS_DIR}/waynabox.conf /etc/nginx/sites-available/
sed -i -e "s/server_name {front_machine_url};/server_name ${FRONT_HOST};/g" /etc/nginx/sites-available/waynabox.conf
sed -i -e "s/index {index_app};/index ${START_PAGE};/g" /etc/nginx/sites-available/waynabox.conf
sed -i "s|{index_app}|${START_PAGE}|g" /etc/nginx/sites-available/waynabox.conf
ln -s /etc/nginx/sites-available/waynabox.conf -t /etc/nginx/sites-enabled/

echo "setting nginx and fpm elements"
cp ${ASSETS_DIR}/nginx.conf /etc/nginx/
cp ${ASSETS_DIR}/php.ini /etc/php/7.0/fpm

echo "Setting xdebug if needed"
if [ "${SERVER_PROFILE}" == "dev" ]
    then
        echo "xdebug.remote_enable = 1" >>  /etc/php/7.0/fpm/conf.d/20-xdebug.ini
        echo "xdebug.remote_autostart = 1" >>  /etc/php/7.0/fpm/conf.d/20-xdebug.ini
        echo "xdebug.remote_host=${XDEBUG_IP}" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini

fi

echo "changing fpm config to work with php7"
sed -i -e "s/;listen.mode = 0660/listen.mode = 0750/g" /etc/php/7.0/fpm/pool.d/www.conf
find /etc/php/7.0/cli/conf.d/ -name "*.ini" -exec sed -i -re 's/^(\s*)#(.*)/\1;\2/g' {} \;

echo "Deleting vendors"
#rm -rf /var/www/current/vendor

# install composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

echo "changing composer.phar property"
chown www-data:www-data /var/www/current/composer.phar

echo "Installing composer"
/var/www/current/composer.phar install

chown -R www-data:www-data /var/www/current/web/bundles
chown -R www-data:www-data /var/www/current/vendor
chown -R www-data:www-data /var/www/current/web
chown -R www-data:www-data /var/www/current/web/bundles/
chown -R www-data:www-data /var/www/current/app/
chown -R www-data:www-data /var/www/current/bin/

echo "Deleting caches"
rm -rf /var/www/current/var/cache
chown -R www-data:www-data /var/www/current/var/

echo "restarting services"
service php7.0-fpm start

nginx
#tail -F /var/log/nginx/error.log
