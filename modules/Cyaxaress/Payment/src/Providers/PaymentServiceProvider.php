<?php
 namespace Cyaxaress\Payment\Providers;

 use Cyaxaress\Course\Models\Course;
 use Cyaxaress\Payment\Gateways\Gateway;
 use Cyaxaress\Payment\Gateways\Zarinpal\ZarinpalAdaptor;
 use Cyaxaress\RolePermissions\Models\Permission;
 use Illuminate\Support\Facades\Artisan;
 use Illuminate\Support\Facades\Route;
 use Illuminate\Support\ServiceProvider;

 class PaymentServiceProvider extends ServiceProvider
 {
     public $namespace = "Cyaxaress\Payment\Http\Controllers";
     public function register()
     {
        $this->loadMigrationsFrom(__DIR__ . " /../Database/Migrations");
        Route::middleware("web")->namespace($this->namespace)->group(__DIR__ . "/../Routes/payment_routes.php");
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", "Payment");
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");
     }

     public function boot()
     {
        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });

//        dd(Route::getRoutes());

         config()->set('sidebar.items.payments', [
             "icon" => "i-transactions",
             "title" => "تراکنش ها",
             "url" => route('payments.index'),
             "permission" => [
                 Permission::PERMISSION_MANAGE_COURSES,
             ]
         ]);
     }
 }
