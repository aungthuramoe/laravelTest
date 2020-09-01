@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center ">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden  border-0 shadow-lg my-5">
                <div class="col card-header">
                    <h1 class="display-5 my-2 text-primary text-center">Update User</h1>
                </div>
                <div class="card-body  p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center ">
                        <div class="col-lg-9">
                            <div class="p-0">
                                <form action="{{ url('/profile/edit/confirm') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-10 col-lg-12 mt-3">
                                            <img style="width:80px;height:80px;" src="/storage/images/{{Auth::user()->profile}}" class="rounded float-right" alt="profile">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-3">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input id="name" type="text" class="form-control form-control-user" name="name" value="{{ $data['name'] ?  $data['name']  :  old('name') }}" placeholder="Name">
                                            @if ($errors->has('name'))
                                            <span class="col-sm-12 mb-sm-0 text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input id="email" type="text" class="form-control form-control-user" name="email" value="{{ $data['email'] ?  $data['email']  :  old('email')  }}" placeholder="Email">
                                            @if ($errors->has('email'))
                                            <span class="col-sm-9 mb-3 mb-sm-0 text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_type" class="col-sm-3 col-form-label">User Type</label>
                                        <div class="col-sm-9">
                                            @can('isAdmin')
                                            <select class="form-control form-control-user" name="type" id="type">
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                            @else
                                            <select class="form-control form-control-user" disabled name="type" id="type">
                                                <option value="User">User</option>
                                            </select>
                                            @endcan
                                            @if ($errors->has('type'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone_number" class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input name="phone" type="text" class="form-control form-control-user" value="{{ $data['phone'] ?  $data['phone']  :  old('phone')  }}" id="phone_number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                                        <div class="col-sm-9">
                                            <input name="dob" type="date" value="{{ $data['dob'] ?  $data['dob']  :  old('dob')  }}" class="form-control form-control-user" id="dob" placeholder="Date of Birth">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <input name="address" type="text" value="{{ $data['address'] ?  $data['address']  :  old('address') }}" class="form-control form-control-user" id="address" placeholder="Address">
                                            @if ($errors->has('address'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="profile_image" class="col-sm-3 col-form-label">Profile Image</label>
                                        <div class="col-sm-9">
                                            <input id="profile_image" accept='image/jpeg , image/jpg,  image/png' type="file" class="form-control form-control-user" name="profile">
                                            @if ($errors->has('profile'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('profile') }}</span>
                                            @endif
                                            <img id="profile_image-tag" width="200px" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <a class="btn btn-link" href="{{route('change-password')}}">
                                            <u class="pb-1">Change Password</u>
                                        </a>
                                    </div>
                                    <button type="submit" class="col-sm-12 col-lg-12 btn btn-success text-uppercase btn-block">Confirm</button>
                                    <button type="reset" class="col-sm-12 col-lg-12 btn btn-primary text-uppercase btn-block mb-3">Clear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_image-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile_image").change(function() {
        readURL(this);
    });
</script>
@endpush