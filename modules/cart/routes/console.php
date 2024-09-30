<?php
use Illuminate\Support\Facades\Schedule;
use Modules\cart\Jobs\RemoveCartAfterOneDay;

Schedule::job(RemoveCartAfterOneDay::class)->everyMinute()->withoutOverlapping();
