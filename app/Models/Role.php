<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    const admin = 'admin';

    const permanentRoles = [self::admin];

    protected $guarded = ['id'];

    public function scopeExcludePermanentRoles($query)
    {
        return $query->whereNotIn('name', self::permanentRoles);
    }
}
