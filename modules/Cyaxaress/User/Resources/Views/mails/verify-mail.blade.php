@component('mail::message')
# کد فعالسازی حساب شما در Hemn_org

این ایمیل به دلیل ثبت نام شما در سایت Hemn_org برای شما ارسال شده است. **در صورتی که ثبت نامی توسط شما انجام نشده است** این ایمیل را نادیده بگیرید.

@component('mail::panel')
کد فعالسازی شما: {{ $code }}
@endcomponent

با تشکر,<br>
{{ config('app.name') }}
@endcomponent
