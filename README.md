# PHP2 run
php -S localhost:8000 -t public
open http://localhost:8000 in your browser

# install dependencies
composer install

# install phpmailer
composer require phpmailer/phpmailer

# update SQL database
import file 'php2(3).sql' into your database

# add file .env with the fllwing content and key google client id, secret and redirect url from googl cloud console
HOST, DB, USER , PASS 

GOOGLE_CLIENT_ID 
GOOGLE_CLIENT_SECRET
GOOGLE_REDIRECT_URL 

