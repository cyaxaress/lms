<?php
namespace Cyaxaress\Discount\Providers;

use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class DiscountServiceProvider extends ServiceProvider
{
    public $namespace = "Cyaxaress\Discount\Http\Controllers";
    public function register()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/discount_routes.php');
        $this->loadViewsFrom(__DIR__  .'/../Resources/Views/', 'Discounts');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function boot()
    {
        config()->set('sidebar.items.discounts', ["icon" => "i-discounts",
            "title" => "تخفیف ها",
            "url" => route('discounts.index'),
            "permission" => Permission::PERMISSION_MANAGE_DISCOUNT
        ]);
    }
}
