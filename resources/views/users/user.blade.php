@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        @if (session('create'))
        <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> {{ session('create') }} </strong>
        </div>
        @endif
        <form class="form-inline mb-3">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="row">
            <div class="col">
                <a href="users/create" type="button" class="btn btn-success mb-3 float-right">Add User <i class="fa fa-user-plus"></i></a>
            </div>
        </div>
        <div class="table-responsive-sm table-responsive-lg table-responsive-xl">
            <table class="table table-hover table-bordered text-center">
                <thead class="thead-dark">
                    <tr class="d-flex">
                        <th class="col-2">Name</th>
                        <th class="col-2">Email</th>
                        <th class="col-1">Created User</th>
                        <th class="col-2">Phone</th>
                        <th class="col-1">Birthdate</th>
                        <th class="col-1">Address</th>
                        <th class="col-1">Created Date</th>
                        <th class="col-1">Updated Date</th>
                        <th class="text-right col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="d-flex">
                        <td class="col-2">{{ $user->name }}</td>
                        <td class="col-2">{{ $user->email }}</td>
                        <td class="col-1">{{ $user->create_user_id }}</td>
                        <td class="col-2">{{ $user->phone }}</td>
                        <td class="col-1">{{ date('d/m/Y', strtotime($user->dob)) }}</td>
                        <td class="col-1">{{ $user->address }}</td>
                        <td class="col-1">{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td class="col-1">{{ date('d/m/Y', strtotime($user->updated_at))}}</td>
                        <td class="text-right col-1">

                            <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                            <a class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</section>
@endsection