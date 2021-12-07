<?php


namespace Cyaxaress\Common\Providers;


use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . "/../Resources", "Common");
    }
    public function boot()
    {
        view()->composer("Dashboard::layout.header", function ($view) {
            $notifications = auth()->user()->unreadNotifications;
            return $view->with(compact("notifications"));
        });
    }
}
