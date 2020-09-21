<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
  //get user list
  public function getUserList();
  // get search user list
  public function getSearchUserList($request);
  // create user
  public function saveUser($request);
  // update user
  public function updateUser($id,$request);
  // delete user
  public function deleteUser($adminID,$userID);
  // view profile
  public function viewProfile($id);
  // update password
  public function updatePassword($id,$password);

}
