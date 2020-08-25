@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <strong>All Post Lists</strong>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        @if ($post->status === 1)
                        <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
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