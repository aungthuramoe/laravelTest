@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <strong>User Profile</strong>
            </div>
            <div class="card-body ml-5">
                <form action="/users/confirm" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="name" value="{{$data['name']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10 col-lg-9">
                            <img style="width:100px;height:80px" src="{{ asset('/storage/images/1.jpg') }}" class="rounded" alt="profile">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="email" value="{{$data['email']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="type" value="{{$data['type']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="phone" value="{{$data['phone']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="dob" value="{{ date('d/m/Y', strtotime($data['dob'])) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="address" value="{{$data['address']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 col-lg-4">
                            <button type="submit" value="create" class="btn form-control btn-primary text-uppercase">Edit</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection