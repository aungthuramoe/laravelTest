@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center ">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden  border-0 shadow-lg my-5">
                <div class="col card-header">
                    <h1 class="display-5 my-2 text-primary text-center">Change Password</h1>
                </div>
                <div class="card-body  p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center ">
                        <div class="col-lg-9">
                            <div class="p-0">
                                <form action="{{route('update-password')}}" method="POST">
                                    @csrf
                                    <div class="form-group row mt-3">
                                        <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                                        <div class="col-sm-9">
                                            <input id="current_password" type="password" class="form-control form-control-user" name="current_password" value="{{ old('current_password') }}" placeholder="Enter Current Password">
                                            @if ($errors->has('current_password'))
                                            <span class="col-sm-12 mb-sm-0 text-danger">{{ $errors->first('current_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input name="password" type="password" value="{{ old('password') }}" class="form-control form-control-user" id="passsword" placeholder="New Password">
                                            @if ($errors->has('password'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row d-flex">
                                        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input name="password_confirmation" type="password" value="{{ old('password') }}" class="form-control form-control-user" id="password_confirmation " placeholder="Confirm Password">
                                            @if (session('error'))
                                                <span class="col-sm-12 mb-3 mb-sm-0 text-danger"> {{ session('error') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="col-sm-12 col-lg-12 btn btn-success text-uppercase btn-block">Change</button>
                                    <button type="reset" class="col-sm-12 col-lg-12 btn btn-primary text-uppercase btn-block mb-3">Clear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>>
@endsection