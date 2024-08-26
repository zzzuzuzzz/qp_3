<?php

namespace App\Services;

use App\Contracts\Repositories\StatisticsRepositoryContract;
use App\Contracts\Services\StatisticsServiceContract;

class StatisticsService implements StatisticsServiceContract
{
    public function __construct(private readonly StatisticsRepositoryContract $statisticsRepository)
    {
    }

    public function getResultArray(): array
    {
        $result = [];

        $result[] = ['Колличество машин: ' . $this->statisticsRepository->getCarsCount(), '', ''];
        $result[] = ['Колличество новостей: ' . $this->statisticsRepository->getArticlesCount(), '', ''];
        $result[] = ['Тег с наибольшим колличсетвом новостей: ' . $this->statisticsRepository->getPopularTag(), '', ''];

        $longArticle = $this->statisticsRepository->getLongArticle();
        $result[] = ['Самая длинная новость. Ее id: ' . $longArticle->id, 'Ее название: ' . $longArticle->title, 'Ее длина: ' . $longArticle->body_length];

        $shortArticle = $this->statisticsRepository->getShortArticle();
        $result[] = ['Самая длинная новость. Ее id: ' . $shortArticle->id, 'Ее название: ' . $shortArticle->title, 'Ее длина: ' . $shortArticle->body_length];

        $result[] = ['Среднее количество новостей у тега: ' . $this->statisticsRepository->avgArticlesForTags(), '', ''];

        $article = $this->statisticsRepository->mostTaggedArticle();
        $result[] = ['Название самой тегированной новости: ' . $article->title, 'ID новости: ' . $article->id, 'Количество тегов: ' . $article->total_tags];

        return $result;
    }
}
