<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdatedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public readonly Article $article)
    {
    }

    public function build(): ArticleUpdatedMail
    {
        return $this
            ->markdown('mail.article-updated-mail')
            ->with([
                'url' => route('article', ['article' => $this->article], true),
            ]);
    }
}
