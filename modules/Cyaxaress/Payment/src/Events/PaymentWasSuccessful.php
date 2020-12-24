<?php

namespace Cyaxaress\Payment\Events;

use Cyaxaress\Payment\Models\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentWasSuccessful
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
