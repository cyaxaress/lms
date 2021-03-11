<?php
namespace Cyaxaress\Discount\Providers;

use Cyaxaress\Discount\Models\Discount;
use Cyaxaress\Discount\Policies\DiscountPolicy;
use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

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
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang/");
        Gate::policy(Discount::class, DiscountPolicy::class);
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
