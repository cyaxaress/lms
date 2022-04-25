<?php

namespace Alikeshtkar\Tag\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->_mergeSidebarItem();
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->_mapWebRoutes();
    }

    /**
     * Define the "web" routes for tag module.
     *
     * @return void
     */
    private function _mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(__DIR__ . '/../../routes/web.php');
    }

    /**
     * @return void
     */
    private function _mergeSidebarItem(): void
    {
        $this->booted(function () {

        });
    }
}
