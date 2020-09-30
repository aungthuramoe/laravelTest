<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * The user service interface instance.
     */
    private $userInterface;
    /**
     * Create a new controller instance.
     *
     * @param UserServiceInterface $userInterface
     * 
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the user.
     *
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userList = $this->userInterface->getUserList();
        return response()->json($userList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('profile')) {
                $filename = $request->profile->getClientOriginalName();
                $request->file('profile')->storeAs(
                    'public/images',
                    $filename
                );
                $request->profile = $filename;
            }
            $this->userInterface->saveUser($request);
            return  response()->json(['status' => 'success', 'message' => "Successfully Crerated"]);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => "Error occur creating user"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->hasFile('profile')) {
                $filename = $request->profile->getClientOriginalName();
                $request->file('profile')->storeAs(
                    'public/images',
                    $filename
                );
                $request->profile = $filename;
            }
            $this->userInterface->updateUser($id, $request);
            return response()->json(['status' => 'success', 'message' => 'Successfully Update', 'filename' => $filename]);
        } catch (Exception $e) {

            return response()->json(['status' => 'error', 'message' => 'error occur in update']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->userInterface->deleteUser(Auth::id(), $id);
        return response()->json(['status' => 'success', 'message' => 'Successfully Deleted']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return void
     */
    public function register(Request $request)
    {
        $this->userInterface->saveUser($request);
    }

    /**
     * Search resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\JsonResponse $users
     */
    public function searchUser(Request $request)
    {
        $users = $this->userInterface->getSearchUserList($request);
        return response()->json($users);
    }

     /**
     * Change Password
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $user = User::find($request->id);
        if (Hash::check($request->currentPassword, $user->password)) {
            $this->userInterface->updatePassword($request->id, $request->password);
            return response()->json(['error' => false, 'messsage' => 'Successfully Update']);
        } else {
            return response()->json(['error' => true, 'messsage' => 'current password is incorrect']);
        }
    }
}
