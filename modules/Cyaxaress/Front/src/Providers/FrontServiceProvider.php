<?php
namespace Cyaxaress\Front\Providers;

use Cyaxaress\Category\Repositories\CategoryRepo;
use Cyaxaress\Course\Repositories\CourseRepo;
use Cyaxaress\Slider\Repositories\SlideRepo;
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

        view()->composer('Front::layout.latestCourses', function ($view) {
            $latestCourses = (new CourseRepo())->latestCourses();
            $view->with(compact('latestCourses'));
        });

        view()->composer('Front::layout.slider', function ($view) {
            $slides = (new SlideRepo())->all();
            $view->with(compact('slides'));
        });


    }
}
