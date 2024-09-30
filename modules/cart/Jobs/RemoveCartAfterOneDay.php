<?php

namespace Modules\cart\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\cart\Models\Cart;
use Modules\cart\Models\Orders;

class RemoveCartAfterOneDay implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct($orderId)
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $carts = Cart::where('updated_at', '>', Carbon::now()->subDay())->cursor();

        foreach ($carts as $cart) {
            \DB::transaction(function () use ($cart) {
                runEvent('product.update.inventory', ['productId' => $cart->product_id, 'kind' => 'increase', 'count' => $cart->count]);
                $cart->delete();
            });
        }
    }
}
