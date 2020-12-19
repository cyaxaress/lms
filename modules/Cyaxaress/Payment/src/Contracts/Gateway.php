<?php

namespace Cyaxaress\Payment\Contracts;

use Cyaxaress\Payment\Models\Payment;

interface Gateway
{
    public function request(Payment $payment);

    public function verify(Payment $payment);
}
