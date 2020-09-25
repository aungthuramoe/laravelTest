<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Log;

/**
 * System Name : Bollentine Board
 * Module Name : UserServie
 */
class UserService implements UserServiceInterface
{
    /**
     * user dao interface instance
     */
    private $userDao;

    /**
     * Class Constructor
     * 
     * @param UserDaoInterface $userDao
     * @return void
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Get User List
     * 
     * @return $userList
     */
    public function getUserList()
    {
        $userList = $this->userDao->getUserList();
        return $userList;
    }
    /**
     * Get User List
     * 
     * @param \Illuminate\Http\Request $request
     * @return $userList
     */
    public function getSearchUserList($request)
    {
        $userList = $this->userDao->getSearchUserList($request);
        return $userList;
    }

    /**
     * Create New User 
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function saveUser($request)
    {
        $this->userDao->saveUser($request);
    }

    /**
     * Update User 
     * 
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function updateUser($id, $request)
    {

        if (Auth::user()) {
            Storage::delete('public/images/' . auth()->user()->profile);
        }
        $this->userDao->updateUser($id, $request);
    }

    /**
     * View Profile
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function viewProfile($id)
    {
        return $this->userDao->viewProfile($id);
    }

    /**
     * Delete User
     * 
     * @param $adminID
     * @param $userID
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($adminID, $userID)
    {
        return $this->userDao->deleteUser($adminID, $userID);
    }

    /**
     * Update Password
     * 
     * @param $id
     * @param $password
     * @return \Illuminate\Http\Response
     */
    public function updatePassword($id, $password)
    {
        return $this->userDao->updatePassword($id, $password);
    }

}
