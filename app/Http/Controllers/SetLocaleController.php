<?php

namespace App\Http\Controllers;

class SetLocaleController extends Controller
{
    public function __invoke($locale)
    {
        auth()->user()->update(['locale' => $locale]);

        return $this->sendResponse();
    }
}
