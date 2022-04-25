<?php

namespace Cyaxaress\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/dashboard_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');
        $this->mergeConfigFrom(__DIR__ . '/../Config/sidebar.php', 'sidebar');
    }

    public function boot()
    {
        config()->set('sidebar.items.dashboard', [
            "icon" => "i-dashboard",
            "title" => "پیشخوان",
            "route_name" => 'home'
        ]);
    }
}
