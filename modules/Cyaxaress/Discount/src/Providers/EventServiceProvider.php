<?php

namespace Cyaxaress\Discount\Providers;

use Cyaxaress\Discount\Listeners\UpdateUsedDiscountsForPayment;
use Cyaxaress\Payment\Events\PaymentWasSuccessful;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessful::class => [
            UpdateUsedDiscountsForPayment::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
