<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     * @param Object
     * @return $postList
     */
    public function getPostList()
    {
        return Post::get();
    }
}
