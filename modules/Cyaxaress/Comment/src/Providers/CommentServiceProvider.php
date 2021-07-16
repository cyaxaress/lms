<?php

namespace Cyaxaress\Comment\Providers;
use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    protected $namespace = "Cyaxaress\Comment\Http\Controllers";
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", "Comments");
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__ . "/../Routes/comments_routes.php");
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
    }

    public function boot()
    {
        config()->set('sidebar.items.comments', [
            "icon" => "i-comments",
            "title" => "نظرات",
            "url" => route('comments.index'),
            "permission" => Permission::PERMISSION_MANAGE_COMMENTS
        ]);
    }
}
