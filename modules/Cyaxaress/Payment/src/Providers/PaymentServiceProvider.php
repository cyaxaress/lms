<?php
 namespace Cyaxaress\Payment\Providers;

 use Cyaxaress\Payment\Gateways\Gateway;
 use Cyaxaress\Payment\Gateways\Zarinpal\ZarinpalAdaptor;
 use Illuminate\Support\ServiceProvider;

 class PaymentServiceProvider extends ServiceProvider
 {
     public function register()
     {
        $this->loadMigrationsFrom(__DIR__ . " /../Database/Migrations");
     }

     public function boot()
     {
        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });
     }
 }
