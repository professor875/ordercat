<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Stage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'cooked_at' => 'datetime',
            'packaging_at' => 'datetime',
            'delivery_at' => 'datetime',
            'delivered_at' => 'datetime',
            'handed_at' => 'datetime',
            'started_at' => 'datetime',
        ];
    }

    public function orderedFor(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'ordered_for_id');
    }

    public function deliveredBy(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'delivered_by_type', 'delivered_by_id');
    }

    public function orderedFrom(): BelongsTo
    {
        return $this->belongsTo(Kitchen::class, 'ordered_from_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function handedTo(): MorphTo
    {
        return $this->morphTo(__FUNCTION__,'handed_to_type', 'handed_to_id');
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'stage_item')->withPivot(['quantity', 'item_rating']);
    }
}
