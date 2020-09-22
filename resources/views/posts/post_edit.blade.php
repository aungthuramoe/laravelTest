@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden  border-0 shadow-lg my-5">
                <div class="col card-header">
                    <h1 class="display-5 my-2 text-primary text-center">Update Post</h1>
                </div>
                <div class="card-body  p-0">
                    <div class="row justify-content-center ">
                        <div class="col-lg-9">
                            <div class="p-0">
                                <form action="/posts/update_confirm/{{$data['id']}}" method="POST" id="post_form" name="formname">
                                    @csrf
                                    <div class="form-group row mt-3">
                                        <label for="title" class="col-sm-3 col-form-label">Post Title</label>
                                        <div class="col-sm-9">
                                            <input id="title" type="text" class="form-control form-control-user" name="title" value="{{$data['title']?$data['title']:old('title')}}" placeholder="Post Title">
                                            @if ($errors->has('title'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label">Post Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control form-control-user rounded-0" id="description" rows="3" name="description" placeholder="Post Description">{{$data['description']}}</textarea>
                                            @if ($errors->has('description'))
                                            <span class="col-sm-12 mb-3 mb-sm-0 text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label">Post Status</label>
                                        <div class="col-sm-9">
                                            <input name="status" data-toggle="toggle" data-on="Active" data-off="InActive" @if($data['status']==1) {{ 'checked' }} @endif data-onstyle="success" data-offstyle="danger" type="checkbox">
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <button class="btn btn-secondary form-control  btn-block active" onclick="customReset();" type="button">
                                                CLEAR
                                            </button>
                                        </div>
                                        <div class="col">
                                            <button value="update" class="btn btn-success form-control btn-block active" type="submit">Confirm</button>
                                        </div>
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
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
<script>
    function customReset() {
        document.getElementById("title").value = "";
        document.getElementById("description").value = "";
    }
</script>
@endpush