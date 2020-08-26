<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\CustomRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    public function index()
    {
        $userList = $this->userInterface->getUserList();
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
        $roles = ['Admin','User'];
        return view('users.create')->with('role',$roles);
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
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);

                $user->type = $request->user_type;
                $user->phone = $request->phone;
                $user->dob = $request->dob;
                $user->address = $request->address;
                $user->profile = "profileImageURL";
                $user->create_user_id = auth()->user()->id;
                $user->updated_user_id = auth()->user()->id;
                $user->deleted_user_id = auth()->user()->id;
                $user->save();

                return redirect('/users')->with('create', 'User Created Successfully');

                break;

            case 'cancel':
                return redirect('/users/create')->withInput();
                break;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        $data['profile'] = auth()->user()->id.'.jpg';
        // $data['profile'] = $request->profile;

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->storeAs(
                'public/images', auth()->user()->id.'.jpg'
            );
        }
        return view('users.user_confirm', compact('data'));
    }
    public function profile()
    {
        $user = User::find(auth()->user()->id);
        if ($user->type == 0) {
            $user->type = "Admin";
        } else {
            $user->type = "User";
        }
        return view('users.profile')->with('data', $user);
    }

}
