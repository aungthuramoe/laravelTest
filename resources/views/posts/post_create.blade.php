@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden  border-0 shadow-lg my-5">
                <div class="col card-header">
                    <h1 class="display-5 my-2 text-primary text-center">Create Post</h1>
                </div>
                @if (session('error'))
                <div class="alert alert-danger alert-dismissable custom-success-box">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ session('error') }} </strong>
                </div>
                @endif
                <div class="card-body  p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center ">
                        <div class="col-lg-9">
                            <div class="p-0">
                                <!-- <form action="{{ url('/users/confirm') }}" method="POST"> -->
                                <form action="/posts/confirm" method="POST">
                                    @csrf
                                    <div class="form-group row mt-3">
                                        <label for="title" class="col-sm-3 col-form-label">Post Title</label>
                                        <div class="col-sm-9">
                                            <input id="title" type="text" class="form-control form-control-user" name="title" value="{{ old('title') }}" placeholder="Post Title">
                                            @if ($errors->has('title'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label">Post Description</label>
                                        <div class="col-sm-9">
                                            <!-- <input id="description" type="text" class="form-control form-control-user"  value="{{ old('description') }}" placeholder="Post Description"> -->
                                            <textarea id="description" class="form-control form-control-user rounded-0" name="description" rows="3" placeholder="Post Description">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <button class="btn btn-primary form-control  btn-block" type="reset">Clear</button></div>
                                        <div class="col">
                                            <button class="btn btn-success form-control btn-block" type="submit">Confirm</button></div>
                                    </div>

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