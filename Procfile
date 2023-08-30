postdeploy: php artisan migrate:fresh --no-interaction --force && php artisan db:seed
queues: php artisan queue:work --queue=high,default
worker: php artisan schedule:work

