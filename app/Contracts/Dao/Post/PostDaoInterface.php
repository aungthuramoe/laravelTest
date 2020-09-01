<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
  public function getPostLists();
  public function getUserPost($id);
  public function getUserSearch($query,$id);
  public function getAdminSearch($query);
  public function editPost($id);
  public function deletePost($userID,$postID);
  public function savePost($request);
  public function updatePost($request,$id);
  public function savePostWithCSV($uploadCSVFile);
  public function downloadPost();
}
