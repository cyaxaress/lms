<?php
 namespace Cyaxaress\Payment\Providers;

 use Illuminate\Support\ServiceProvider;

 class PaymentServiceProvider extends ServiceProvider
 {
     public function register()
     {
        $this->loadMigrationsFrom(__DIR__ . " /../Database/Migrations");
     }

     public function boot()
     {

     }
 }
