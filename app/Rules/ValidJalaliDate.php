<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Morilog\Jalali\Jalalian;

class ValidJalaliDate implements Rule
{
    public $error;
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        try{
            Jalalian::fromFormat("Y/m/d H:i", $value)->toCarbon();
            return true;
        } catch (\Exception $exception){
            $this->error = $exception->getMessage() . " - {$value}";
            return false;
        }
    }

    public function message()
    {
        return 'یک تاریخ معتبر شمسی انتخاب کنید' . " ({$this->error})";
    }
}
