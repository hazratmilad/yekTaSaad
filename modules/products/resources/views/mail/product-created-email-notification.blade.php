@component('mail::message')
    <div style="direction: rtl;text-align: right">
        <span style="font-weight: bold;font-size:20px">
              اطلاع رسانی ایجاد محصول جدید
        </span>
        <div class="text-center green-color" style="padding:15px;font-size:20px;">
            محصول {{ $product->title }} ایجاد شد.
        </div>
    </div>
@endcomponent

