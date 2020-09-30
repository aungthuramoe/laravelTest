<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Exports\PostExport;
use App\Imports\PostImport;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     * 
     * @return $postList
     */
    public function getPostLists()
    {
        return Post::latest()->paginate(8);
    }

    /**
     * Get User Post List
     * 
     * @param int $id
     * 
     * @return $postList
     */
    public function getUserPost($id)
    {
        return Post::where('create_user_id', '=', $id)->paginate(2);
    }

    /**
     * Get Search Post List
     * 
     * @param int $id
     * @param string $query
     * @return $posts
     */
    public function getUserSearch($query, $id)
    {
        $posts = Post::query()
            ->where('title', 'LIKE',  '%' . $query . '%')
            ->orWhere('description',  'LIKE',  '%' . $query . '%')
            ->where('create_user_id', $id)
            ->paginate(5);
        return $posts;
    }

    /**
     * Get Search Post List
     * 
     * @param string $query
     * 
     * @return $posts
     */
    public function getAdminSearch($query)
    {
        $posts = Post::query()
            ->where('title', 'LIKE',  '%' . $query . '%')
            ->orWhere('description',  'LIKE',  '%' . $query . '%')
            ->orWhere('create_user_id', $query)
            ->paginate(5);
        return $posts;
    }

    /**
     *  Get the specified post data.
     * 
     * @param int $id
     * @return $post
     */
    public function editPost($id)
    {
        return  Post::find($id);
    }

    /**
     * Post Delete
     * 
     * @param $userID
     * @param $postID
     * @return void
     */
    public function deletePost($userID, $postID)
    {
        $post = Post::find($postID);
        $post->deleted_user_id = $userID;
        $post->save();
        $post->delete();
    }

    /**
     * Storing Post into Database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function savePost($request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->description =  $request->description;
        if (Auth::user()) {
            $post->create_user_id = auth()->user()->id;
            $post->updated_user_id = auth()->user()->id;
        } else {
            $post->create_user_id = 31;
            $post->updated_user_id = 31;
        }
        $post->save();
    }

    /**
     * Update Post 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return void
     */
    public function updatePost($request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->update();
    }

    /**
     * Save Post with CSV 
     *
     * @param  \Illuminate\Http\Request  $uploadCSVFile
     * @return void
     */
    public function savePostWithCSV($uploadCSVFile)
    {
        Excel::import(new PostImport, $uploadCSVFile);
    }

    /**
     * Download Post with Xlsx extension
     *
     * @return posts.xlsx file
     */
    public function downloadPost()
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }

    /**
     * Return PostList to download in Vue
     *
     * @param $id
     * @param $type
     * @return posts 
     */
    public function downloadPostForVueExcel($id,$type)
    {
        if ($type == 0) {
            $posts = Post::get();
        } else {
            
            $posts = Post::where('create_user_id', $id)->get();
        }
        return $posts;
    }
}
