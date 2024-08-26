<?php

namespace App\Listeners;

use App\Events\ArticleCreatedEvent;
use App\Mail\NewArticleCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendMailOnNewArticleCreatedListener
{
    public function handle(ArticleCreatedEvent $event): void
    {
        if ($email = config('mail.from.address')) {
            Mail::to($email)->send(new NewArticleCreatedMail($event->article()));
        }  
    }
}
