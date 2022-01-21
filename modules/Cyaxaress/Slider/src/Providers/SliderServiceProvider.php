<?php

namespace Cyaxaress\Slider\Providers;

use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\Slider\Models\Slide;
use Cyaxaress\Slider\Policies\SlidePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    private $namespace = "Cyaxaress\Slider\Http\Controllers";
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/slider_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Slider');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . "/../Routes/slider_routes.php");

        Gate::policy(Slide::class, SlidePolicy::class);
    }
    public function boot()
    {
        config()->set('sidebar.items.slider', [
            "icon" => "i-courses",
            "title" => "اسلایدر",
            "url" => route('slides.index'),
            "permission" => [
                Permission::PERMISSION_MANAGE_SLIDES,
            ]
        ]);
    }
}
