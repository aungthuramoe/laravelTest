<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDao implements UserDaoInterface
{
    /**
     * Get Operator List
     * @param Object
     * @return $operatorList
     */
    public function getUserList()
    {
        return User::latest()->paginate(8);
    }
    public function getSearchUserList($request)
    {
        $userList = DB::table('users')
            ->where('name', '=', $request->name)
            ->orWhere('email', '=', $request->email)
            ->orWhere('created_at', '>=', $request->from)
            ->where('created_at', '<=', $request->to)
            ->whereNull('deleted_at')
            ->paginate(5);
        return $userList;
    }

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
    public function updateUser($id,$request)
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
    public function deleteUser($adminID, $userID)
    {
        $user = User::find($userID);
        $user->deleted_user_id = $adminID;
        $user->deleted_at = now();
        $user->save();
    }
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
    public function updatePassword($id, $password)
    {
        $user = User::find($id);
        $user->password = Hash::make($password);
        $user->save();
    }
}
