@extends('layouts.app')

@section('content')

<section>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <strong>My Posts</strong><small class="text-danger ml-5">I need to change some condition</small>
            </div>
            <div class="card-body">
                <!-- <h5 class="card-title">All Users</h5> -->
                @if (session('update'))
                <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ session('update') }} </strong>
                </div>
                @endif
                <!-- @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif -->
                @if(session()->has('delete'))
                <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ session('delete') }} </strong>
                </div>
                @endif
                @if(session()->has('create'))
                <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ session('create') }} </strong>
                </div>
                @endif
                @guest
                @else
                <!-- <button class="btn btn-success mb-3 float-right" data-toggle="modal" data-target="#add-post">Add Post <i class="fa fa-plus fa-lg"></i></button> -->
                <a href="posts/upload" type="button" class="btn btn-primary mb-3 justify-content-center">Upload <i class="fa fa-upload"></i></a>
                <a href="{{ route('export') }}" type="button" class="btn btn-primary mb-3 float-center">Download <i class="fa fa-download"></i></a>
                <a href="posts/create" type="button" class="btn btn-success mb-3 float-right">Add Post <i class="fa fa-plus fa-lg"></i></a>
                @endguest
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Posted User</th>
                            <th scope="col">Posted Date</th>
                            @guest
                            @else
                            <th class="text-right">Actions</th>
                            @endguest
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->create_user_id}}</td>
                            <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                            @guest
                            @else
                            <td class="text-right">
                                <!-- <button data-id="{{$post->id}}" data-title="{{$post->title}}" data-description="{{$post->description}}" class="btn btn-primary px-3" data-toggle="modal" data-target="#edit-post">Edit <i class="fa fa-edit"></i></button> -->
                                <button data-id="{{$post->id}}" data-title="{{$post->title}}" data-description="{{$post->description}}" class="btn btn-primary px-3" data-toggle="modal" data-target="#view-post">View <i class="fa fa-eye"></i></button>
                                <a href="{{ route('edit',['id'=>$post->id])}}" class="btn btn-primary">Edit <i class="fa fa-edit"></i></a>
                                <button data-id="{{$post->id}}" class="btn btn-danger" data-toggle="modal" data-target="#delete-post"> Delete <i class="fa fa-trash"></i></button>
                            </td>
                            @endguest
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>

    </div>
    <div class="modal" id="add-post" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary  text-center w-100"><strong>Create Post</strong></h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/posts/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label><strong>Post Title</strong></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Post Title"></input><br>
                        </div>
                        <div class="form-group">
                            <label><strong>Post Description</strong></label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Post Description"></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success text-uppercase  btn-block mx-2">Create</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
    <!-- <div class="modal" id="edit-post" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary  text-center w-100"><strong>Edit Post</strong></h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/posts/update" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label><strong>Post Title</strong></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Post Title"></input><br>
                            <input type="text" class="form-control" hidden id="post_id" name="post_id"></input>
                        </div>
                        <div class="form-group">
                            <label><strong>Post Description</strong></label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Post Description"></input>
                        </div>
       
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label">Status</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success text-uppercase  btn-block mx-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
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
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label><strong>Post Title</strong></label>
                            <input type="text" readonly class="form-control" id="title" name="title"></input><br>
                        </div>
                        <div class="form-group">
                            <label><strong>Post Description</strong></label>
                            <input type="text" readonly class="form-control" id="description" name="description"></input>
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
        // $('#edit-post').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var id = button.data('id')
        //     var title = button.data('title')
        //     var description = button.data('description')
        //     var modal = $(this)
        //     modal.find('#post_id').val(id)
        //     modal.find('#title').val(title)
        //     modal.find('#description').val(description)
        // })
        $('#view-post').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var title = button.data('title')
            var description = button.data('description')
            var modal = $(this)
            modal.find('#title').val(title)
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