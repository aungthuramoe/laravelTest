<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmPasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userInterface;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userList = $this->userInterface->getUserList($request);
        // if($userList->count() == 0){
        //     return redirect()->back()->with('error','User Not Found');
        // }
        return view('users.user', [
            'users' => $userList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->input('status')) {
            case 'create':
                try {
                    $this->userInterface->saveUser($request);
                    return redirect('/users')->with('message', 'Successfully User Created ');
                } catch (QueryException $e) {
                    return redirect('/users')->with('error', 'Error Creating User');
                }
                break;
            case 'update':
                try {
                    $this->userInterface->updateUser(Auth::id(), $request);
                    return redirect('/profile')->with('message', 'Successfully Update');
                } catch (QueryException $e) {
                    return redirect('/users')->with('error', 'Error Updating Profile');
                }
                break;
            case 'cancel':
                return redirect('/users/create')->withInput();
                break;
            case 'update-cancel':
                return redirect('/profile/edit')->withInput();
                break;
        }
    }
    public function destroy(Request $request)
    {
        if ($request->user_id == Auth::id()) {
            return redirect('/users')->with('error', 'You cannot delete yourself');
        }
        $this->userInterface->deleteUser(Auth::id(), $request->user_id);
        return redirect('/users')->with('message', 'Successfully Delete ');
    }
    public function confirm(CreateUserRequest $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['user_type'] = $request->user_type;
        $data['phone_number'] = $request->phone_number;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['address'] = $request->address;

        if ($request->hasFile('profile')) {
            $filename = $request->profile->getClientOriginalName();
            $data['profile'] = $filename;
            $path = $request->file('profile')->storeAs(
                'public/images',
                $filename
            );
        }
        return view('users.user_confirm', compact('data'));
    }
    public function updateConfirm(UpdateUserRequest $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['type'] = $request->type;
        $data['phone'] = $request->phone;
        $data['dob'] = $request->dob;
        $data['address'] = $request->address;
        if ($request->hasFile('profile')) {
            $filename = $request->profile->getClientOriginalName();
            $data['profile'] = $filename;
            $path = $request->file('profile')->storeAs(
                'public/images',
                $filename
            );
        }
        return view('users.user_update_confirm', compact('data'));
    }
    public function viewProfile()
    {
        $user = $this->userInterface->viewProfile(Auth::id());
        return view('users.profile')->with('data', $user);
    }
    public function changePassword()
    {
        return view('users.change_password');
    }
    public function editProfile(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['type'] = $request->user_type;
        $data['dob'] =  Carbon::parse($request->dob)->format('Y-m-d');
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        return view('users.edit_profile', compact('data'));
    }
    public function updatePassword(ConfirmPasswordRequest $request)
    {
        if ((Hash::check($request->password, Auth::user()->password))) {
            return back()->with('error', 'current password and new password cannot same');
        }
        $this->userInterface->updatePassword(Auth::id(), $request->password);
        return redirect('/')->with('change_password', "Change Password Successfully");
    }
}
