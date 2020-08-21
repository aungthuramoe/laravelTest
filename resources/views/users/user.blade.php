@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="card">
                <div class="card-header">
                    <strong>All User Lists</strong>
                </div>
                <div class="card-body">
                    <!-- <h5 class="card-title">All Users</h5> -->
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <a href="users/create" type="button" class="btn btn-success mb-3 float-right">Add User <i class="fa fa-user-plus"></i></a>
                    <table class="table table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            @if(count($users) > 0 )
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="text-right">
                                    <button class="btn btn-primary px-3">View <i class="fa fa-eye"></i></button>
                                    <button class="btn btn-primary px-3">Edit <i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger">Delete <i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection