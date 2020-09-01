<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
  //get post list
  public function getPostLists();
  public function getUserPost($type,$id,$query);
  public function editPost($id);
  public function deletePost($userID,$postID);
  public function savePost($request);
  public function updatePost($request,$id);
  public function savePostWithCSV($uploadCSVFile);
  public function downloadPost();
}