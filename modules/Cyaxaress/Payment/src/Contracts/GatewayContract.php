<?php

namespace Cyaxaress\Payment\Contracts;

use Cyaxaress\Payment\Models\Payment;

interface GatewayContract
{
    public function request($amount, $description);

    public function verify(Payment $payment);

    public function redirect();

    public function getName();
}
