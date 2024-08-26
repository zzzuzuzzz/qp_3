<?php

namespace App\Listeners;

use App\Events\ArticleDelitedEvent;
use App\Mail\ArticleDelitedMail;
use Illuminate\Support\Facades\Mail;

class SendMailOnArticleDelitedListener
{
    public function handle(ArticleDelitedEvent $event): void
    {
        if ($email = config('mail.from.address')) {
            Mail::to($email)->send(new ArticleDelitedMail($event->article()));
        }         
    }
}
