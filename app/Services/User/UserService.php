<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Exception;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    private $userDao;

    /**
     * Class Constructor
     * @param OperatorUserDaoInterface
     * @return
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Get User List
     * @param Object
     * @return $userList
     */
    public function getUserList($request)
    {
        if ($request->name != null || $request->email != null || $request->from != null || $request->to) {
            try {
                $userList = $this->userDao->getSearchUserList($request);
            } catch (Exception $e) {
                dd($e);
                // return redirect('/users')->with('error', 'Please enter correct date format yy-m-d or yy/m/d');
            }
        } else {
            $userList = $this->userDao->getUserList();
        }
        return $userList;
    }

    public function saveUser($request)
    {
        $this->userDao->saveUser($request);
    }
    public function updateUser($id, $request)
    {
        if (auth()->user()->profile) {
            Storage::delete('public/images/' . auth()->user()->profile);
        }
        $this->userDao->updateUser($id, $request);
    }
    public function viewProfile($id)
    {
        return $this->userDao->viewProfile($id);
    }
    public function deleteUser($adminID, $userID)
    {
        return $this->userDao->deleteUser($adminID, $userID);
    }
    public function updatePassword($id, $password)
    {
        return $this->userDao->updatePassword($id, $password);
    }
}
