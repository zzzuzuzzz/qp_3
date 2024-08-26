<?php

namespace App\Listeners;

use App\Events\ArticleUpdatedEvent;
use App\Mail\ArticleUpdatedMail;
use Illuminate\Support\Facades\Mail;

class SendMailOnArticleUpdatedListener
{
    public function handle(ArticleUpdatedEvent $event): void
    {
        if ($email = config('mail.from.address')) {
            Mail::to($email)->send(new ArticleUpdatedMail($event->article()));
        }  
    }
}
