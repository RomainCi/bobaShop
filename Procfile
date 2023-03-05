postdeploy: php artisan migrate:refresh --no-interaction --force
postdeploy:php artisan db:seed
queues: php artisan queue:work --queue=high,default
