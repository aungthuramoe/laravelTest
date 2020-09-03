<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Exception;
use Illuminate\Database\QueryException;

class PostService implements PostServiceInterface
{
    private $postDao;

    /**
     * Class Constructor
     * @param OperatorUserDaoInterface
     * @return
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Get User List
     * @param Object
     * @return $userList
     */
    public function getPostLists()
    {
        return $this->postDao->getPostLists();
    }
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
    public function editPost($id)
    {
        return $this->postDao->editPost($id);
    }
    public function deletePost($userID, $postID)
    {
        return $this->postDao->deletePost($userID, $postID);
    }
    public function savePost($request)
    {
        try {
            $this->postDao->savePost($request);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }
    public function updatePost($request, $id)
    {
        try {
            $this->postDao->updatePost($request, $id);
            return true;
        } catch (QueryException $e) {
            return false;
        }
    }
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
    public function downloadPost()
    {
        return $this->postDao->downloadPost();
    }
}
