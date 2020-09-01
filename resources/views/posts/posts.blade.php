@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        @if (session('change_password'))
        <div class="alert alert-success alert-dismissable custom-success-box">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ session('change_password') }} </strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <strong>All Post Lists</strong>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Posted User</th>

                            <th scope="col">Posted Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        @if ($post->status === 1)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->create_user_id}}</td>

                            <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection