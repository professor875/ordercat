<?php

namespace App\Enums;

enum ContactTypeEnum: string
{
    case delivery = 'delivery';
    case kitchen_admin = 'kitchen_admin';
    case building_representative = 'building_representative';
}
