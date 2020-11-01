<?php
namespace Cyaxaress\Front\Providers;

use Cyaxaress\Category\Models\Category;
use Cyaxaress\Category\Repositories\CategoryRepo;
use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . "/../Routes/front_routes.php");
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", "Front");

        view()->composer('Front::layout.header', function ($view) {
            $categories = (new CategoryRepo())->tree();
            $view->with(compact('categories'));
        });
    }
}
