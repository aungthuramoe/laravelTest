<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmPasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Log;
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
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if ($request->hasFile('profile')) {
        //     $filename = $request->profile->getClientOriginalName();
        //     $data['profile'] = $filename;
        //     $path = $request->file('profile')->storeAs(
        //         'public/images',
        //         $filename
        //     );
        // }
        //$this->userInterface->saveUser($request);
        try {
            $this->userInterface->saveUser($request);
            return  response()->json(['status' => 'success', 'message' => "Successfully Crerated"]);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => "Email  Already Exit", 'error' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int AdminID (Temp = 19,Auth::id() is empty)
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userInterface->deleteUser(19, $id);
        return response()->json(['status' => 'success','message'=>'Successfully Deleted']);
    }
    public function register(Request $request)
    {
        $this->userInterface->saveUser($request);
    }
    public function searchUser(Request $request)
    {
        $users = $this->userInterface->getSearchUserList($request);
        return response()->json($users);
    }
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
