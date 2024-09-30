<?php

namespace Modules\products\Events;


use Illuminate\Support\Facades\Mail;
use Modules\products\Mail\SendProductCreationNotification;
use Modules\products\Models\Product;

class ProductCreationEmailNotification
{
    public function handle(Product $product): void
    {
        $email = new SendProductCreationNotification($product);
        Mail::to('admin@yektasaad.com')->send($email);
    }
}
