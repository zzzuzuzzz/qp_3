<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleDelitedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public readonly Article $article)
    {
    }

    public function build(): ArticleDelitedMail
    {
        return $this->markdown('mail.article-delited-mail');
    }
}
