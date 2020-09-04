@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden  border-0 shadow-lg my-5">
                <div class="col card-header">
                    <h1 class="display-5 my-2 text-primary text-center">Create User</h1>
                </div>
                @if (session('error'))
                 <div class="alert alert-danger alert-dismissable custom-success-box">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ session('error') }} </strong>
                </div>
                @endif
                <div class="card-body  p-0">
                    <div class="row justify-content-center ">
                        <div class="col-lg-9">
                            <div class="p-0">
                                <form action="{{ url('/users/confirm') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mt-3">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input id="name" type="text" class="form-control form-control-user" name="name" value="{{ old('name') }}" placeholder="Name">
                                            @if ($errors->has('name'))
                                            <span class="col-sm-12 mb-sm-0 text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input id="email" type="text" class="form-control form-control-user" name="email" value="{{ old('email') }}" placeholder="Email">
                                            @if ($errors->has('email'))
                                            <span class="col-sm-9 mb-3 mb-sm-0 text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input name="password" type="password" value="{{ old('password') }}" class="form-control form-control-user" id="passsword" placeholder="Password">
                                            @if ($errors->has('password'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input name="password_confirmation" type="password" value="{{ old('password') }}" class="form-control form-control-user" id="password_confirmation " placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_type" class="col-sm-3 col-form-label">User Type</label>
                                        <div class="col-sm-9">
                                            <select name="user_type" class="form-control" id="user_type">
                                                <option hidden disabled selected> -- Select User Type --</option>
                                                <option value="Admin" @if (old('user_type')=="Admin" ) {{ 'selected' }} @endif>Admin</option>
                                                <option value="User" @if (old('user_type')=="User" ) {{ 'selected' }} @endif>User</option>
                                            </select>
                                            @if ($errors->has('user_type'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('user_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input name="phone" type="text" class="form-control form-control-user" value="{{ old('phone') }}" id="phone" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                                        <div class="col-sm-9">
                                            <input name="dob" type="date" value="{{ old('dob') }}" class="form-control form-control-user" id="dob" placeholder="Date of Birth">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <input name="address" type="text" value="{{ old('address') }}" class="form-control form-control-user" id="address" placeholder="Address">
                                            @if ($errors->has('address'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="profile_image" class="col-sm-3 col-form-label">Profile Image</label>
                                        <input id="profile_image" type="file" class="form-control form-control-user" hidden name="profile" accept='image/jpeg , image/jpg, image/gif, image/png'>
                                        <div class="col-sm-9">
                                            <a id="upload" class="btn btn-light rounded-0 border bg-light">Choose File</a>
                                            <span id="selected_filename">No file chosen</span>
                                            <br>
                                            @if ($errors->has('profile'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('profile') }}</span>
                                            @endif
                                            <br>
                                            <img id="profile_image-tag" class="mt-2" width="150px" />
                                        </div>
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
            localStorage.setItem("filename", input.files[0].name);
            // localStorage.setItem("file", input.files[0]);
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_image-tag').attr('src', e.target.result);
                localStorage.setItem("file", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            console.log("click open");
        } else {
            //$('#profile_image').val(localStorage.getItem("file"));
            console.log("profile value is ", $('#profile_image').val());
            //console.log(localStorage.getItem("file"));
            // $('#profile_image').val(localStorage.getItem("file"));
            //console.log(localStorage.getItem("filename"));
            //$(this).next('.custom-file-label').html(localStorage.getItem("filename"));
            $('#profile_image-tag').attr('src', '');
        }
    }
    $("#profile_image").change(function() {
        readURL(this);
    });
</script>
<script>
    $(document).ready(function() {
        $('#upload').click(function() {
            $("#profile_image").click();
        });
    });
    $('#profile_image').change(function() {
        //console.log($('#profile_image')[0].files[0].name);
        $('#selected_filename').text($('#profile_image')[0].files[0].name);
    });
</script>
@endpush