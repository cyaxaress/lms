<?php

namespace Cyaxaress\Payment\Providers;

use Cyaxaress\Payment\Events\PaymentWasSuccessful;
use Cyaxaress\Payment\Listeners\AddSellersShareToHisAccount;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessful::class => [
            AddSellersShareToHisAccount::class
        ]
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
