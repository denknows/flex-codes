<?php

namespace App\Providers;

use Codes\App\Repositories\CustomerInterface;
use Codes\App\Repositories\CustomerPersistence;
use Codes\App\Repositories\ImportDataInterface;
use Codes\App\Repositories\ImportDataPersistence;
use Codes\App\Repositories\ImportDataRepository;
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
        $this->app->bind(CustomerInterface::class, CustomerPersistence::class);
        $this->app->bind(ImportDataInterface::class, ImportDataPersistence::class);
    }
}
