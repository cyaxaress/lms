<?php
namespace Cyaxaress\Media\Providers;

use Cyaxaress\Course\Database\Seeds\RolePermissionTableSeeder;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {
//        $this->loadRoutesFrom(__DIR__ . '/../Routes/media_routes.php');
//        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Media');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', "Media");
    }

    public function boot()
    {

    }
}
