<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
  //get post list
  public function getPostLists();
  //get user post
  public function getUserPost($type,$id,$query);
  //edit post
  public function editPost($id);
  //delete post
  public function deletePost($userID,$postID);
  //create post
  public function savePost($request);
  //update post
  public function updatePost($request,$id);
  //creat post with CSV
  public function savePostWithCSV($uploadCSVFile);
  //download post with xlsx extension
  public function downloadPost();
// download post with xlsx extension for axios
  public function downloadPostForVueExcel($type,$id);
}