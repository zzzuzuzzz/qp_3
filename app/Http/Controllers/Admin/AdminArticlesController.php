<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\Articles\ArticleCreationServiceContract;
use App\Contracts\Services\Articles\ArticleRemoverServiceContract;
use App\Contracts\Services\Articles\ArticleUpdateServiceContract;
use App\Contracts\Services\Flash\FlashMessageContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\TagsRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

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
        Gate::authorize('viewAny', Article::class);
        $articles = $this->articlesRepository->findAll();
        return view('pages.admin.articles.list', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Article::class);
        return view('pages.admin.articles.create', ['article' => $this->articlesRepository->getArticle()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ArticleRequest $request,
        ArticleCreationServiceContract $articleCreationService,
        TagsRequest $tagsRequest,
        TagsSynchronizerServiceContract $tagsSynchronizerService,
        FlashMessageContract $flashMessage
    ): RedirectResponse {
        Gate::authorize('create', Article::class);
        $article = $articleCreationService->create($request->validated());
        $tagsSynchronizerService->sync($article, $tagsRequest->get('tags'));
        $flashMessage->success('Новость успешно создана');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $article = $this->articlesRepository->getById($id, ['image']);
        Gate::authorize('update', $article);
        return view('pages.admin.articles.edit', ['article' => $article]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(
        ArticleRequest $request,
        TagsRequest $tagsRequest,
        int $id,
        FlashMessageContract $flashMessage,
        ArticleUpdateServiceContract $articleUpdateService,
        TagsSynchronizerServiceContract $tagsSynchronizerService,
    ): RedirectResponse {
        Gate::authorize('update', $this->articlesRepository->getById($id));
        $article = $articleUpdateService->update($id, $request->validated());
        $tagsSynchronizerService->sync($article, $tagsRequest->get('tags'));
        $flashMessage->success('Новость успешно обновлена');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        int $id,
        ArticleRemoverServiceContract $articleRemoverService,
        FlashMessageContract $flashMessage,
    ): RedirectResponse {
        Gate::authorize('delete', $this->articlesRepository->getById($id));
        $articleRemoverService->delete($id);
        $flashMessage->success('Новость удалена');
        return back();
    }
}
