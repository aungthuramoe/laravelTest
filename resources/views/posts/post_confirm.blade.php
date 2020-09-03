@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="card">
                <div class="card-header text-center">
                    <strong>Confirm Post</strong>
                </div>
                <div class="card-body">
                    <form action="/posts/store" method="POST">
                        @csrf
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
                            <div class="col-sm-10 col-lg-4">
                                <button type="submit" value="cancel" name="cancel" class="btn btn-primary  form-control text-uppercase">Cancel Post</i></button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 col-lg-4">
                                <button type="submit"  class="btn form-control btn-success text-uppercase">Create Post</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection