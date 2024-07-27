<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StageItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function stage(): BelongsTo {
        return $this->belongsTo(Stage::class);
    }
    public function item(): BelongsTo {
        return $this->belongsTo(Item::class);
    }
}
