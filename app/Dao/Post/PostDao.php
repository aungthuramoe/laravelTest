<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Exports\PostExport;
use App\Imports\PostImport;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     * @return $postList
     */
    public function getPostLists()
    {
        return Post::latest()->paginate(10);
    }
    public function getUserPost($id)
    {
        return Post::where('create_user_id', '=', $id)->paginate(2);
    }
    public function getUserSearch($query, $id)
    {
        $posts = Post::query()
            ->where('title', 'LIKE',  '%' . $query . '%')
            ->orWhere('description',  'LIKE',  '%' . $query . '%')
            ->where('create_user_id', $id)
            ->paginate(5);
        return $posts;
    }
    public function getAdminSearch($query)
    {
        $posts = Post::query()
            ->where('title', 'LIKE',  '%' . $query . '%')
            ->orWhere('description',  'LIKE',  '%' . $query . '%')
            ->orWhere('create_user_id', $query)
            ->paginate(5);
        return $posts;
    }

    public function editPost($id)
    {
        return  Post::find($id);
    }
    public function deletePost($userID, $postID)
    {
        $post = Post::find($postID);
        $post->deleted_user_id = $userID;
        $post->save();
        $post->delete();
    }
    public function savePost($request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->description =  $request->description;
        $post->create_user_id = auth()->user()->id;
        $post->updated_user_id = auth()->user()->id;
        $post->save();
    }
    public function updatePost($request,$id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        
        $post->update();
    }
    public function savePostWithCSV($uploadCSVFile)
    {
        Excel::import(new PostImport, $uploadCSVFile);
    }

    public function downloadPost()  
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }
}
