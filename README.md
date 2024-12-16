git clone https://github.com/melek123M/erp-laravel.git

cd erp-laravel

docker run --rm -v $(pwd):/opt -w /opt laravelsail/php84-composer:latest composer install

docker-compose up -d

docker exec -it laravel.test bash 

php artisan migrate
composer update
npm install
npm run dev



En cas de besoin, n'hésitez pas à me contacter par téléphone ou par email.(56753684 malekmtibaa20@gmail.com)
