<?php

namespace App\Enums;

enum ContactChannelEnum: string
{
    case sms = 'sms';
    case email = 'email';
    case whatsapp = 'whatsapp';
    case phone = 'phone';
}
