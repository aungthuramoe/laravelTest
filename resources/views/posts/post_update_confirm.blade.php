@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="card">
                <div class="card-header text-center">
                    <strong>Update Confirm Post</strong>
                </div>
                <div class="card-body">
                    <form action="/posts/update/{{$data['id']}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Post Title</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" name="title" value="{{$data['title']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Post Description</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" name="description" value="{{$data['description']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Post Status</label>
                            <div class="col-sm-10">
                                <input type="text" hidden readonly class="form-control-plaintext" name="status" value="{{$data['status']}}">
                                <input  disabled data-toggle="toggle" data-on="Active" data-off="InActive" @if($data['status']==1) {{ 'checked' }} @endif data-onstyle="success" data-offstyle="danger" type="checkbox">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 col-lg-4">
                                <button type="submit" value="cancel" name="cancel" class="btn btn-secondary  form-control text-uppercase active">Cancel Post</i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 col-lg-4">
                                <button type="submit" class="btn form-control btn-success text-uppercase active">Update Post</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@endpush