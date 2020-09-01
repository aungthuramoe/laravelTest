<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
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
        switch ($request->input('status')) {
            case 'create':
                try {
                    $this->postDao->savePost($request);
                    return true;
                } catch (QueryException $e) {
                    return false;
                }
                break;
            case 'cancel':
                return redirect()->back()->withInput();
                break;
        }
    }
    public function updatePost($request,$id)
    {
        $this->postDao->updatePost($request,$id);
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
