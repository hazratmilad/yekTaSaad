<?php

namespace Modules\cart\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'count',
        'user_id',
        'product_id',
        'price'
    ];
}
