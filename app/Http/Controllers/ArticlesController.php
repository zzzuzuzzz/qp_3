<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\Articles\ArticlesDataCollectorServiceContract;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    public function articles(
            Request $request,
            ArticlesDataCollectorServiceContract $articlesDataCollectorService
    ): View {
        $articlesData = $articlesDataCollectorService->collectArticlesData(
            5,
            $request->get('page', 1)
        );
        return view('pages.articles', ['articlesData' => $articlesData]);
    }
    public function article(int $id, ArticlesRepositoryContract $articlesRepository): View
    {
        $article = $articlesRepository->getById($id, ['image', 'tags']);
        return view('pages.article', ['article' => $article]);
    }
}
