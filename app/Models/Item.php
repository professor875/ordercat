<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'days' => 'json',
            'types' => 'json',
        ];
    }

    public function stages(): BelongsToMany
    {
        return $this->belongsToMany(Stage::class, 'stage_item');
    }
}
