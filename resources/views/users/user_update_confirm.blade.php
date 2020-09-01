@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <strong>Confirm User Update</strong>
            </div>
            <div class="card-body ml-5">
                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-10 col-lg-9">
                            <input type="hidden" name="profile" value="{{$data['profile']}}">
                            <img style="width:80px;height:80px;" src="/storage/images/{{$data['profile']}}" class="rounded float-right" alt="profile">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="name" value="{{$data['name']}}">
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
                            <input type="text" readonly class="form-control-plaintext" name="user_type" value="{{$data['type']}}">
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
                            <input type="text" readonly class="form-control-plaintext" name="dob" value="{{$data['dob']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="address" value="{{$data['address']}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 col-lg-8">
                            <button type="submit" value="update-cancel" name="status" class="btn btn-primary  form-control text-uppercase">Cancel</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 col-lg-8">
                            <button type="submit" value="update" name="status" class="btn form-control btn-success text-uppercase">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection