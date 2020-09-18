<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Log;
class UserDao implements UserDaoInterface
{
    /**
     * Get getUserList List
     * 
     * @return $userList
     */
    public function getUserList()
    {
        return User::latest()->paginate(8);
    }

    /**
     * Get Search User List
     * 
     * @param \Illuminate\Http\Request $request
     * @return $userList 
     */
    public function getSearchUserList($request)
    {
        $userList = User::select('*')
            ->where(function ($query) use ($request) {
                if ($request->name != null) {
                    $query->where('name', '=', $request->name);
                }
                if ($request->email != null) {
                    $query->orWhere('email', '=', $request->email);
                }
                if ($request->from != null) {
                    $query->orWhere("created_at", ">=", $request->from);
                }
                if ($request->to != null) {
                    $query->where("created_at", "<=", $request->to);
                }
            })
            ->paginate(8);
        return $userList;
    }

    /**
     * Create User
     * 
     * @param \Illuminate\Http\Request
     * @return void
     */
    public function saveUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->user_type == "Admin") {
            $user->type = 0;
        } else {
            $user->type = 1;
        }
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->profile = $request->profile;
        $user->create_user_id = auth()->user()->id;
        $user->updated_user_id = auth()->user()->id;
        $user->save();
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->user_type == "Admin") {
            $user->type = 0;
        } else {
            $user->type = 1;
        }
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->profile = $request->profile;
        $user->create_user_id = auth()->user()->id;
        $user->updated_user_id = auth()->user()->id;
        $user->save();
    }

     /**
     * Delete User
     * 
     * @param $adminID
     * @param $userID
     * @return void
     */
    public function deleteUser($adminID, $userID)
    {
        $user = User::find($userID);
        $user->deleted_user_id = $adminID;
        $user->deleted_at = now();
        $user->save();
    }

    /**
     * View Profile
     * 
     * @param $id
     * @return $user
     */
    public function viewProfile($id)
    {
        $user = User::find($id);
        if ($user->type == 0) {
            $user->type = "Admin";
        } else {
            $user->type = "User";
        }
        return $user;
    }

    /**
     *Update Password
     * 
     * @param $id
     * @param $password
     * @return void
     */
    public function updatePassword($id, $password)
    {
        $user = User::find($id);
        $user->password = Hash::make($password);
        $user->save();
    }

    public function getUserInfo($email)
    {
        try {
            $user = User::where('email',$email)->first();
            return $user;
        }catch(Exception $e){
            Log::info("error");
            throw new Exception($e);
        }
        
    }
}
