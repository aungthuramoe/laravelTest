<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
  //get user list
  public function getUserList();
  public function getSearchUserList($request);
  public function saveUser($request);
  public function updateUser($id,$request);
  public function deleteUser($adminID,$userID);
  public function viewProfile($id);
  public function updatePassword($id,$password);
}
