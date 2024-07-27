<?php

namespace App\Http\Controllers;

use App\Traits\ResponseMethodsTrait;

abstract class Controller
{
    use ResponseMethodsTrait;

    protected function ifAuthorized($permission): void
    {
        abort_if(!auth()->user()->can($permission), 401);
    }
}
