<?php

namespace Modules\products\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\products\Observers\ProductObserver;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'inventory'
    ];
    protected $visible = [
        'title',
        'price',
        'inventory'
    ];
}
