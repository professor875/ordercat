<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Translation extends Component
{
    public array $translation;

    public function render(): View
    {
        $locale = app()->getLocale();
        $filePath = base_path("/lang/$locale.json");

        if (file_exists($filePath)) {
            $this->translation = json_decode(file_get_contents(base_path("/lang/$locale.json")), true);
        } else {
            $this->translation = [];
        }

        return view('components.translation');
    }
}
