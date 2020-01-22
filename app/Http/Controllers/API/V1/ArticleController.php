<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /** @var User */
    private $user;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->authorizeResource(Article::class);
        $this->middleware('auth')->except(['index', 'show']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $articles = Article::without('author')->paginate();
        return ArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return ArticleResource
     */
    public function store(CreateRequest $request)
    {
        $article = $this->user->articles()->save(Article::make($request->validated()));
        return ArticleResource::make($article);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(UpdateRequest $request, Article $article)
    {
        /**
         * Important things is validated()
         */
        $article->update($request->validated());

        return ArticleResource::make($article->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return Response
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return \response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
