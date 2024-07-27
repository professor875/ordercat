<?php

namespace App\Mail;

use App\Models\Stage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KitchenRatingMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly  Stage $stage, public readonly  User $actor)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kitchen Rating',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.kitchen-rating',
        );
    }
}
