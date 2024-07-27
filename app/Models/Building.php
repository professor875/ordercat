<?php

namespace App\Models;

use App\Enums\BuildingTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'type' => BuildingTypeEnum::class,
        ];
    }

    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class, 'ordered_for_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
