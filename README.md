

/usr/local/bin/php82 /usr/local/bin/composer.phar update
cd /home/customer/www/app.consultile.com/public_html/ && php82 artisan schedule:run >> /dev/null 2>&1
cd /home/customer/www/emails.consultile.com/public_html/ && php -q cron.php
