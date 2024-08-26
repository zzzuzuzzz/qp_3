<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArticleCreatedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public readonly Article $article)
    {
    }

    public function build(): NewArticleCreatedMail
    {
        return $this
            ->markdown('mail.new-article-created-mail')
            ->with([
                'url' => route('article', ['article' => $this->article], true),
            ]);
    }
}
