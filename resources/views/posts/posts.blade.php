@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
       <x-alert />
        @if(Auth()->check())
        <div class="d-flex ">
            <div class="py-2 flex-grow-1">
                <form class="form-inline" action="{{ route('search') }}" method="POST">
                    @csrf
                    <div class="col-xs-3">
                        <input class="form-control" name="q" value="@if(isset($data['q'])) {{$data['q']}} @endif" type="search" placeholder="Search">
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-outline-primary ml-3 active" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="py-2">
                <a href="posts/upload" type="button" class="btn btn-primary float-right d-none d-md-block">
                    Upload <i class="fa fa-upload"></i>
                </a>
            </div>
            <div class="p-2">
                <a href="{{ route('export') }}" type="button" class=" btn btn-primary float-right d-none d-md-block">
                    Download <i class="fa fa-download"></i>
                </a>
            </div>
            <div class="py-2">
                <a href="posts/create" type="button" class="btn btn-success float-right d-none d-md-block">
                    Add Post <i class="fa fa-plus fa-lg"></i>
                </a>
            </div>
        </div>
        @endif
        <div class="table-responsive-sm table-responsive-lg table-responsive-xl">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        @if(Auth()->check())
                        <th scope="col">Status</th>
                        @endif
                        <th scope="col">Posted User</th>
                        <th scope="col">Posted Date</th>
                        @if(Auth()->check())
                        <th class="text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        @if(Auth()->check())
                        <td>{{$post->status}}</td>
                        @endif
                        <td>{{$post->create_user_id}}</td>
                        <td>{{ date('Y/m/d', strtotime($post->created_at)) }}</td>
                        @if(Auth()->check())
                        @can('isAdmin')
                        <td class="text-right">
                            <button data-id="{{$post->id}}" data-post_date="{{date('d/m/Y', strtotime($post->created_at))}}" data-title="{{$post->title}}" data-description="{{$post->description}}" class="btn btn-sm btn-primary px-3" data-toggle="modal" data-target="#view-post">View <i class="fa fa-eye"></i></button>
                            <a href="{{ route('edit',['id'=>$post->id])}}" class="btn btn-sm btn-primary">Edit <i class="fa fa-edit"></i></a>
                            <button data-id="{{$post->id}}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-post"> Delete <i class="fa fa-trash"></i></button>
                        </td>
                        @else
                        @if(Auth()->id() === $post->create_user_id)
                        <td class="text-right">
                            <button data-id="{{$post->id}}" data-post_date="{{date('d/m/Y', strtotime($post->created_at))}}" data-title="{{$post->title}}" data-description="{{$post->description}}" class="btn btn-sm btn-primary px-3" data-toggle="modal" data-target="#view-post">View <i class="fa fa-eye"></i></button>
                            <a href="{{ route('edit',['id'=>$post->id])}}" class="btn btn-sm btn-primary">Edit<i class="fa fa-edit"></i></a>
                            <button data-id="{{$post->id}}" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-post">Delete <i class="fa fa-trash"></i></button>
                        </td>
                        @endif
                        @endcan
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</section>
<div class="modal" id="view-post" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary  text-center w-100"><strong>Post Details</strong></h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Post Title</label>
                        <div class="col-sm-8 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="title" id="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Post Description</label>
                        <div class="col-sm-8 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="description" id="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Posted Date</label>
                        <div class="col-sm-8 col-lg-6">
                            <input type="text" readonly class="form-control-plaintext" name="post_date" id="post_date">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="delete-post" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Are you sure you want to delete ?</strong></h5>
            </div>
            <form action="/posts/delete" method="POST">
                @csrf
                @method('DELETE')
                <input type="text" class="form-control" hidden id="post_id" name="post_id"></input>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-uppercase">Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#view-post').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var title = button.data('title')
        var description = button.data('description')
        var post_date = button.data('post_date')
        var modal = $(this)
        modal.find('#title').val(title)
        modal.find('#post_date').val(post_date)
        modal.find('#description').val(description)
    })
    $('#delete-post').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('#post_id').val(id)
    })
</script>
@endpush