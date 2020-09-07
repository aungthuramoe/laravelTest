<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Database\QueryException;

/**
 * System Name : Bollentine Board
 * Module Name : PostServie
 */
class PostService implements PostServiceInterface
{
    /**
     * The post dao interface instance.
     */
    private $postDao;

    /**
     * Class Constructor
     * 
     * @param PostDaoInterface $postDao
     * @return void
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Get User List
     * 
     * @return $posts
     */
    public function getPostLists()
    {
        return $this->postDao->getPostLists();
    }

    /**
     * Get PostList
     * 
     * @return $posts
     */
    public function getUserPost($type, $id, $query)
    {
        if ($type == 0) {
            if ($query != null) {
                $posts = $this->postDao->getAdminSearch($query);
            } else {
                $posts = $this->postDao->getPostLists();
            }
        } else {
            if ($query != null) {
                $posts = $this->postDao->getUserSearch($query, $id);
            } else {
                $posts = $this->postDao->getUserPost($id);
            }
        }
        return $posts;
    }

    /**
     * Get the specified post data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPost($id)
    {
        return $this->postDao->editPost($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userID
     * @param  int  $postID
     * @return \Illuminate\Http\Response
     */
    public function deletePost($userID, $postID)
    {
        return $this->postDao->deletePost($userID, $postID);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function savePost($request)
    {
        try {
            $this->postDao->savePost($request);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return bool
     */
    public function updatePost($request, $id)
    {
        try {
            $this->postDao->updatePost($request, $id);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $uploadCSVFile
     * @return bool
     */
    public function savePostWithCSV($uploadCSVFile)
    {
        if ($uploadCSVFile) {
            try {
                $this->postDao->savePostWithCSV($uploadCSVFile);
                return true;
            } catch (QueryException $e) {
                return false;
            }
        }
    }

    /**
     * Download post
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPost()
    {
        return $this->postDao->downloadPost();
    }
}
