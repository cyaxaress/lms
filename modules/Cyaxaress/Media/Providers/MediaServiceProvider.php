<?php
namespace Cyaxaress\Media\Providers;

use Cyaxaress\Course\Database\Seeds\RolePermissionTableSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    protected $namespace = 'Cyaxaress\Media\Http\Controllers';

    public function register()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/media_routes.php');

//        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Media');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
//        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');
//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang/', "Media");
        $this->mergeConfigFrom(__DIR__ . "/../Config/mediaFile.php", 'mediaFile');
    }

    public function boot()
    {

    }
}
