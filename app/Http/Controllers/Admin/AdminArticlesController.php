<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\FlashMessageContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\TagsRequest;
use Illuminate\Http\RedirectResponse;

class AdminArticlesController extends Controller
{
    public function __construct(private readonly ArticlesRepositoryContract $articlesRepository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = $this->articlesRepository->findAll();
        return view('pages.admin.articles.list', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.articles.create', ['article' => $this->articlesRepository->getArticle()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ArticleRequest $request,
        TagsRequest $tagsRequest,
        FlashMessageContract $flashMessage,
        TagsSynchronizerServiceContract $tagsSynchronizerService,
    ): RedirectResponse {
        $article = $this->articlesRepository->create($request->validated());
        $tagsSynchronizerService->sync($article, $tagsRequest->get('tags'));
        $flashMessage->success('Новость успешно создана');
        return redirect()->route('admin.articles.index');
    }
}
