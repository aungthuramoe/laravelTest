<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
  //get user list
  public function getUserList($request);
  public function saveUser($request);
  public function updateUser($id,$request);
  public function deleteUser($adminID,$userID);
  public function viewProfile($id);
  public function updatePassword($id,$password);
}
