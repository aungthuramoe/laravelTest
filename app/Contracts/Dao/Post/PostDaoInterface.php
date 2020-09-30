<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    // get post list
    public function getPostLists();
    // get user post
    public function getUserPost($id);
    //gett user post with query and user id
    public function getUserSearch($query,$id);
    //get serarch  post with query
    public function getAdminSearch($query);
    // edit post
    public function editPost($id);
    //delete post
    public function deletePost($userID,$postID);
    // create post
    public function savePost($request);
    // update post
    public function updatePost($request,$id);
    // create post with CSV
    public function savePostWithCSV($uploadCSVFile);
    // download post with xlsx extension
    public function downloadPost();
    // download post with xlsx extension for axios
    public function downloadPostForVueExcel($id,$type);
}
