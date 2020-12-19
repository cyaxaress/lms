<?php

namespace Cyaxaress\Payment\Gateways\Zarinpal;
class zarinpal
{
    private function curl_check()
    {
        return (function_exists('curl_version')) ? true : false;
    }

    private function soap_check()
    {
        return (extension_loaded('soap')) ? true : false;
    }

    private function error_message($code, $desc, $cb, $request=false)
    {
        if (empty($cb) && $request === true)
        {
            return "لینک بازگشت ( CallbackURL ) نباید خالی باشد";
        }

        if (empty($desc) && $request === true)
        {
            return "توضیحات تراکنش ( Description ) نباید خالی باشد";
        }


        $error = array(
            "-1" 	=> "اطلاعات ارسال شده ناقص است.",
            "-2" 	=> "IP و يا مرچنت كد پذيرنده صحيح نيست",
            "-3" 	=> "با توجه به محدوديت هاي شاپرك امكان پرداخت با رقم درخواست شده ميسر نمي باشد",
            "-4" 	=> "سطح تاييد پذيرنده پايين تر از سطح نقره اي است.",
            "-11" 	=> "درخواست مورد نظر يافت نشد.",
            "-12" 	=> "امكان ويرايش درخواست ميسر نمي باشد.",
            "-21" 	=> "هيچ نوع عمليات مالي براي اين تراكنش يافت نشد",
            "-22" 	=> "تراكنش نا موفق ميباشد",
            "-33" 	=> "رقم تراكنش با رقم پرداخت شده مطابقت ندارد",
            "-34" 	=> "سقف تقسيم تراكنش از لحاظ تعداد يا رقم عبور نموده است",
            "-40" 	=> "اجازه دسترسي به متد مربوطه وجود ندارد.",
            "-41" 	=> "اطلاعات ارسال شده مربوط به AdditionalData غيرمعتبر ميباشد.",
            "-42" 	=> "مدت زمان معتبر طول عمر شناسه پرداخت بايد بين 30 دقيه تا 45 روز مي باشد.",
            "-54" 	=> "درخواست مورد نظر آرشيو شده است",
            "100" 	=> "عمليات با موفقيت انجام گرديده است.",
            "101" 	=> "عمليات پرداخت موفق بوده و قبلا PaymentVerification تراكنش انجام شده است.",
        );

        if (array_key_exists("{$code}", $error))
        {
            return $error["{$code}"];
        } else {
            return "خطای نامشخص هنگام اتصال به درگاه زرین پال";
        }
    }

    private function zarinpal_node()
    {
        if ($this->curl_check() === true)
        {
            $ir_ch = curl_init("https://www.zarinpal.com/pg/services/WebGate/wsdl");
            curl_setopt($ir_ch, CURLOPT_TIMEOUT, 1);
            curl_setopt($ir_ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ir_ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ir_ch);
            $ir_info = curl_getinfo($ir_ch);
            curl_close($ir_ch);

            $de_ch = curl_init("https://de.zarinpal.com/pg/services/WebGate/wsdl");
            curl_setopt($de_ch, CURLOPT_TIMEOUT, 1);
            curl_setopt($de_ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($de_ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($de_ch);
            $de_info = curl_getinfo($de_ch);
            curl_close($de_ch);

            $ir_total_time = (isset($ir_info['total_time']) && $ir_info['total_time'] > 0) ? $ir_info['total_time'] : false;
            $de_total_time = (isset($de_info['total_time']) && $de_info['total_time'] > 0) ? $de_info['total_time'] : false;

            return ($ir_total_time === false || $ir_total_time > $de_total_time) ? "de" : "ir";
        } else {
            if (function_exists('fsockopen'))
            {
                $de_ping 	= $this->zarinpal_ping("de.zarinpal.com", 80, 1);
                $ir_ping 	= $this->zarinpal_ping("www.zarinpal.com", 80, 1);

                $de_domain 	= "https://de.zarinpal.com/pg/services/WebGate/wsdl";
                $ir_domain 	= "https://www.zarinpal.com/pg/services/WebGate/wsdl";

                $ir_total_time = (isset($ir_ping) && $ir_ping > 0) ? $ir_ping : false;
                $de_total_time = (isset($de_ping) && $de_ping > 0) ? $de_ping : false;

                return ($ir_total_time === false || $ir_total_time > $de_total_time) ? "de" : "ir";
            } else {
                $webservice = "https://www.zarinpal.com/pg/services/WebGate/wsd";
                $headers 	= @get_headers($webservice);

                return (strpos($headers[0], '200') === false) ? "de" : "ir";
            }
        }
    }

    private function zarinpal_ping($host, $port, $timeout)
    {
        $time_b 	= microtime(true);
        $fsockopen 	= @fsockopen($host, $port, $errno, $errstr, $timeout);

        if (!$fsockopen)
        {
            return false;
        }  else {
            $time_a = microtime(true);
            return round((($time_a - $time_b) * 1000), 0);
        }
    }

    public function redirect($url)
    {
        @header('Location: '. $url);
        echo "<meta http-equiv='refresh' content='0; url={$url}' />";
        echo "<script>window.location.href = '{$url}';</script>";
        exit;
    }

    public function request($MerchantID, $Amount, $Description="", $Email="", $Mobile="", $CallbackURL, $SandBox=false, $ZarinGate=false)
    {
        $ZarinGate = ($SandBox == true) ? false : $ZarinGate;

        if ($this->soap_check() === true)
        {
            $node 	= ($SandBox == true) ? "sandbox" : $this->zarinpal_node();
            $upay 	= ($SandBox == true) ? "sandbox" : "www";

            $client = new SoapClient("https://{$node}.zarinpal.com/pg/services/WebGate/wsdl", ['encoding' => 'UTF-8']);

            $result = $client->PaymentRequest([
                'MerchantID'     => $MerchantID,
                'Amount'         => $Amount,
                'Description'    => $Description,
                'Email'          => $Email,
                'Mobile'         => $Mobile,
                'CallbackURL'    => $CallbackURL,
            ]);

            $Status 		= (isset($result->Status) 		&& $result->Status != "") 		? $result->Status : 0;
            $Authority 		= (isset($result->Authority) 	&& $result->Authority != "") 	? $result->Authority : "";
            $StartPay 		= (isset($result->Authority) 	&& $result->Authority != "") 	? "https://{$upay}.zarinpal.com/pg/StartPay/". $Authority : "";
            $StartPayUrl 	= (isset($ZarinGate) 			&& $ZarinGate == true) 			? "{$StartPay}/ZarinGate" : $StartPay;

            return array(
                "Node" 		=> "{$node}",
                "Method" 	=> "SOAP",
                "Status" 	=> $Status,
                "Message" 	=> $this->error_message($Status, $Description, $CallbackURL, true),
                "StartPay" 	=> $StartPayUrl,
                "Authority" => $Authority
            );
        } else {
            $node 	= ($SandBox == true) ? "sandbox" : "ir";
            $upay 	= ($SandBox == true) ? "sandbox" : "www";

            $data = array(
                'MerchantID'     => $MerchantID,
                'Amount'         => $Amount,
                'Description'    => $Description,
                'CallbackURL'    => $CallbackURL,
            );

            $jsonData = json_encode($data);
            $ch = curl_init("https://{$upay}.zarinpal.com/pg/rest/WebGate/PaymentRequest.json");
            curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($jsonData)));

            $result = curl_exec($ch);
            $err 	= curl_error($ch);
            curl_close($ch);

            $result = json_decode($result, true);

            if ($err)
            {
                $Status 		= 0;
                $Message 		= "cURL Error #:" . $err;
                $Authority 		= "";
                $StartPay 		= "";
                $StartPayUrl 	= "";
            } else {
                $Status 		= (isset($result["Status"]) 	&& $result["Status"] != "") 	? $result["Status"] : 0;
                $Message 		= $this->error_message($Status, $Description, $CallbackURL, true);
                $Authority 		= (isset($result["Authority"]) 	&& $result["Authority"] != "") 	? $result["Authority"] : "";
                $StartPay 		= (isset($result["Authority"]) 	&& $result["Authority"] != "") 	? "https://{$upay}.zarinpal.com/pg/StartPay/". $Authority : "";
                $StartPayUrl 	= (isset($ZarinGate) 			&& $ZarinGate == true) 			? "{$StartPay}/ZarinGate" : $StartPay;
            }

            return array(
                "Node" 		=> "{$node}",
                "Method" 	=> "CURL",
                "Status" 	=> $Status,
                "Message" 	=> $Message,
                "StartPay" 	=> $StartPayUrl,
                "Authority" => $Authority
            );
        }
    }

    public function verify($MerchantID, $Amount, $SandBox=false, $ZarinGate=false)
    {
        $ZarinGate = ($SandBox == true) ? false : $ZarinGate;

        if ($this->soap_check() === true)
        {
            $au 	= (isset($_GET['Authority']) && $_GET['Authority'] != "") ? $_GET['Authority'] : "";
            $node 	= ($SandBox == true) ? "sandbox" : $this->zarinpal_node();

            $client = new SoapClient("https://{$node}.zarinpal.com/pg/services/WebGate/wsdl", ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification([
                'MerchantID'     => $MerchantID,
                'Authority'      => $au,
                'Amount'         => $Amount,
            ]);

            $Status 		= (isset($result->Status) 		&& $result->Status != "") 		? $result->Status 	: 0;
            $RefID 			= (isset($result->RefID) 		&& $result->RefID != "") 		? $result->RefID 	: "";
            $Message 		= $this->error_message($Status, "", "", false);

            return array(
                "Node" 		=> "{$node}",
                "Method" 	=> "SOAP",
                "Status" 	=> $Status,
                "Message" 	=> $Message,
                "Amount" 	=> $Amount,
                "RefID" 	=> $RefID,
                "Authority" => $au
            );
        } else {
            $au 	= (isset($_GET['Authority']) && $_GET['Authority'] != "") ? $_GET['Authority'] : "";
            $node 	= ($SandBox == true) ? "sandbox" : "ir";
            $upay 	= ($SandBox == true) ? "sandbox" : "www";

            $data = array('MerchantID' => $MerchantID, 'Authority' => $au, 'Amount' => $Amount);
            $jsonData = json_encode($data);
            $ch = curl_init("https://{$upay}.zarinpal.com/pg/rest/WebGate/PaymentVerification.json");
            curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($jsonData)));

            $result = curl_exec($ch);
            $err 	= curl_error($ch);
            curl_close($ch);

            $result = json_decode($result, true);

            if ($err)
            {
                $Status 		= 0;
                $Message 		= "cURL Error #:" . $err;
                $Status 		= "";
                $RefID 			= "";
            } else {
                $Status 		= (isset($result["Status"]) && $result["Status"] != "") ? $result["Status"] : 0;
                $RefID 			= (isset($result['RefID']) 	&& $result['RefID'] != "") 	? $result['RefID'] 	: "";
                $Message 		= $this->error_message($Status, "", "", false);
            }

            return array(
                "Node" 		=> "{$node}",
                "Method" 	=> "CURL",
                "Status" 	=> $Status,
                "Message" 	=> $Message,
                "Amount" 	=> $Amount,
                "RefID" 	=> $RefID,
                "Authority" => $au
            );
        }
    }
}
