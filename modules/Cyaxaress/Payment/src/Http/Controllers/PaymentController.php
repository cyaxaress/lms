<?php

namespace Cyaxaress\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Cyaxaress\Payment\Events\PaymentWasSuccessful;
use Cyaxaress\Payment\Gateways\Gateway;
use Cyaxaress\Payment\Models\Payment;
use Cyaxaress\Payment\Repositories\PaymentRepo;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(PaymentRepo $paymentRepo)
    {
        $this->authorize("manage", Payment::class);
        $payments = $paymentRepo->paginate();
        return view("Payment::index", compact("payments"));
    }
    public function callback(Request $request)
    {
        $gateway = resolve(Gateway::class);
        $paymentRepo = new PaymentRepo();
        $payment = $paymentRepo->findByInvoiceId($gateway->getInvoiceIdFromRequest($request));
        if (!$payment) {
            newFeedback("تراکنش ناموفق", "تراکنش مورد نظر یاقت نشد!", "error");
            return redirect("/");
        }

        $result = $gateway->verify($payment);

        if (is_array($result)) {
            newFeedback("عملیات ناموفق", $result['message'], "error");
            $paymentRepo->changeStatus($payment->id, Payment::STATUS_FAIL);
            //todo
        }else{
            event(new PaymentWasSuccessful($payment));
            newFeedback("عملیات موفق", "پرداخت با موفقیت انجام شد.", "success");
            $paymentRepo->changeStatus($payment->id, Payment::STATUS_SUCCESS);
        }

        return redirect()->to($payment->paymentable->path());
    }
}
