<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return Response::allow();

    }

    /**
     * Determine whether the user can view the article.
     *
     * @param User $user
     * @param Article $article
     * @return mixed
     */
    public function view(?User $user, Article $article)
    {
        return true;
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_verified;
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param User $user
     * @param Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param User $user
     * @param Article $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param User $user
     * @param Article $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }


}
