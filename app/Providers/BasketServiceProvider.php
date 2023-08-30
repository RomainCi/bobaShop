<?php

namespace App\Providers;

use App\Services\BasketService;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class BasketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // Dans la méthode boot d'un fournisseur de services
        $this->app->singleton(BasketService::class, function ($app) {
            $request = $app->make(Request::class);
            $token = $request->cookie('basket_token','null');
            return new BasketService($token);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
