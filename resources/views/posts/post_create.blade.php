@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center ">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden  border-0 shadow-lg my-5">
                <div class="col card-header">
                    <h1 class="display-5 my-2 text-primary text-center">Create Post</h1>
                </div>
                <div class="card-body  p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center ">
                        <div class="col-lg-9">
                            <div class="p-0">
                                <!-- <form action="{{ url('/users/confirm') }}" method="POST"> -->
                                <form action="/posts/confirm" method="POST">
                                    @csrf
                                    <!-- <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                                        </div>
                                    </div> -->
                                    <div class="form-group row mt-3">
                                        <label for="title" class="col-sm-3 col-form-label">Post Title</label>
                                        <div class="col-sm-9">
                                            <input id="title" type="text" class="form-control form-control-user" name="title" placeholder="Post Title">
                                        </div>
                                        @if ($errors->has('title'))
                                        <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label">Post Description</label>
                                        <div class="col-sm-9">
                                            <input id="description" type="text" class="form-control form-control-user" name="description" placeholder="Post Description">
                                        </div>
                                        @if ($errors->has('description'))
                                        <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <button class="btn btn-primary form-control  btn-block" type="reset">Clear</button></div>
                                        <div class="col">
                                            <button id="btnSubmit" class="btn btn-success form-control btn-block" type="submit">Confirm</button></div>
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