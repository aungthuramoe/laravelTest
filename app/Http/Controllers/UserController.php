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


/**
 * SystemName : Bulletinboard
 * ModuleName : User
 */
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
    public function index(Request $request)
    {
        $userList = $this->userInterface->getUserList();
        return view('users.user', [
            'users' => $userList,
        ]);
    }
    /**
     * Search User
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if (empty($request->name) && empty($request->email) && empty($request->from) && empty($request->to)) {
            return redirect()->back()->with("error", "Please fill at least one field");
        }
        $users = $this->userInterface->getSearchUserList($request);
        if ($users->count() == 0) {
            return redirect()->back()->withInput()->with('error', 'User Not Found');
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['from'] =  Carbon::parse($request->from)->format('Y-m-d');
        $data['to'] =  Carbon::parse($request->to)->format('Y-m-d');
        return view('users.user', compact('users', 'data'));
    }
    /**
     * Show the form for creating and updating user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
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
                    return redirect('/users/create')->withInput()->with('error', 'Error Creating User');
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

    /**
     * Remove the specified user from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->user_id == Auth::id()) {
            return redirect('/users')->with('error', 'You cannot delete yourself');
        }
        $this->userInterface->deleteUser(Auth::id(), $request->user_id);
        return redirect('/users')->with('message', 'Successfully Delete ');
    }
    /**
     * Show  conifrmation form to  create
     *
     * @param App\Http\Requests\CreateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(CreateUserRequest $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['user_type'] = $request->user_type;
        $data['phone_number'] = $request->phone;
        $data['date_of_birth'] = $request->dob;
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

    /**
     * Show conifrmation form to  update
     * 
     * @param  App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show Profile Information
     * 
     * @return \Illuminate\Http\Response
     */
    public function viewProfile()
    {
        $user = $this->userInterface->viewProfile(Auth::id());
        return view('users.profile')->with('data', $user);
    }

    /**
     * Change Password
     * 
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('users.change_password');
    }

    /**
     * Edit Profile Information
     * 
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
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

    
     /**
     * Show Profile Information
     * 
     * @return App\Http\Requests\ConfirmPasswordRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(ConfirmPasswordRequest $request)
    {
        if ((Hash::check($request->password, Auth::user()->password))) {
            return back()->with('error', 'current password and new password cannot same');
        }
        $this->userInterface->updatePassword(Auth::id(), $request->password);
        return redirect('/')->with('message', "Change Password Successfully");
    }
}
