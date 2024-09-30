<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Modules\users\Models\User;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponder;

    public ?User $user;

    public function __construct()
    {
        $this->user = auth('sanctum')->check() ? auth('sanctum')->user() : null;
    }
}
