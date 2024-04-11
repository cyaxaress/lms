<?php

namespace Cyaxaress\Course\Providers;

use Cyaxaress\Course\Listeners\RegisterUserInTheCourse;
use Cyaxaress\Payment\Events\PaymentWasSuccessful;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessful::class => [
            RegisterUserInTheCourse::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
