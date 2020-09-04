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

    }
}
