<?php
 namespace Cyaxaress\Payment\Providers;

 use Cyaxaress\Course\Models\Course;
 use Cyaxaress\Payment\Gateways\Gateway;
 use Cyaxaress\Payment\Gateways\Zarinpal\ZarinpalAdaptor;
 use Illuminate\Support\Facades\Route;
 use Illuminate\Support\ServiceProvider;

 class PaymentServiceProvider extends ServiceProvider
 {
     public $namespace = "Cyaxaress\Payment\Http\Controllers";
     public function register()
     {
        $this->loadMigrationsFrom(__DIR__ . " /../Database/Migrations");
        Route::middleware("web")->namespace($this->namespace)->group(__DIR__ . "/../Routes/payment_routes.php");
     }

     public function boot()
     {
        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });

//        Course::resolveRelationUsing("payments", function ($courseModel) {
//            return $courseModel->morphMany(Payment::class, "paymentable");
//        });
     }
 }
