Installation

git clone git@github.com:menvil/apitoxml.git

cd apitoxml

cp .env.example .env

composer install

./vendor/bin/sail up -d

./vendor/bin/sail php artisan key:generate

Try this http://localhost

Or Try this with parameter http://localhost?limit=5
