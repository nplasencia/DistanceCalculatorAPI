<?php

namespace App\Providers;

use App\Services\DistanceSumService;
use App\Services\DistanceSumServiceInterface;
use App\Services\DistanceTransformService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DistanceSumServiceInterface::class, function () {
            return new DistanceSumService(new DistanceTransformService());
        });
    }
}
