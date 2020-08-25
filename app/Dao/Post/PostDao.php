<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     * @return $postList
     */
    public function getPostList()
    {
        return Post::latest()->paginate(10);
    }
    public function userPost($id)
    {
        return Post::where('create_user_id', '=',$id)->paginate(2);
    }
}
