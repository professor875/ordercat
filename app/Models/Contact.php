<?php

namespace App\Models;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'type' => ContactTypeEnum::class,
            'contact_channel' => ContactChannelEnum::class,
        ];
    }
}
