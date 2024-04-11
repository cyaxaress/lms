<?php

namespace Cyaxaress\Discount\Listeners;

class UpdateUsedDiscountsForPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        foreach ($event->payment->discounts as $discount) {
            $discount->uses++;
            if (! is_null($discount->usage_limitation)) {
                $discount->usage_limitation--;
            }
            $discount->save();
        }
    }
}
