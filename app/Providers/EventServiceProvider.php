<?php

use App\Events\ArticleCreatedEvent;
use App\Events\ArticleDelitedEvent;
use App\Events\ArticleUpdatedEvent;
use App\Listeners\SendMailOnArticleDelitedListener;
use App\Listeners\SendMailOnNewArticleCreatedListener;
use App\Listeners\SendMailOnArticleUpdatedListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ArticleCreatedEvent::class => [SendMailOnNewArticleCreatedListener::class],
        ArticleUpdatedEvent::class => [SendMailOnArticleUpdatedListener::class],
        ArticleDelitedEvent::class => [SendMailOnArticleDelitedListener::class],
    ];
}