@extends('layouts.app')

@section('content')
<section>
    <div class="container mt-5">
        <x-alert />
        <div class="row">
            <form class="form-inline mb-3" action="{{url('/users')}}" method="POST">
                @csrf
                <div class="col-xs-2 ml-3">
                    <input class="form-control" id='name' name="name" type="text" value="@if (isset($data['name'])) {{$data['name']}} @endif" placeholder="Search By Name">
                </div>
                <div class="col-xs-2 ml-3">
                    <input class="form-control" name="email" type="text" value="@if (isset($data['email'])) {{$data['email']}} @endif" placeholder="Search By Email">
                </div>
                <div class="col-xs-2 ml-3">
                    <input class="form-control" id="from" name="from" type="date" value="@if (isset($data['from'])){{$data['from']}}@endif">
                </div>
                <div class="col-xs-2 ml-3">
                    <input class="form-control" id="to" name="to" type="date" value="@if (isset($data['to'])){{$data['to']}}@else @endif">
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-outline-primary my-2 ml-2 my-sm-0 active" type="submit">Search</button>
                </div>
            </form>
            <div class="col">
                <a href="users/create" type="button" class="btn btn-success float-right"><i class="fa fa-user-plus"></i></a>
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
                        <td class="col-1">{{ date('Y/m/d', strtotime($user->dob)) }}</td>
                        <td class="col-1">{{ $user->address }}</td>
                        <td class="col-1">{{ date('Y/m/d', strtotime($user->created_at)) }}</td>
                        <td class="col-1">{{ date('Y/m/d', strtotime($user->updated_at))}}</td>
                        <td class="text-right col-1">
                            <button data-name="{{$user->name}}" data-email="{{$user->email}}" data-address="{{$user->address}}" data-phone="{{$user->phone}}" data-dob="{{ date('d/m/Y', strtotime($user->dob))}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view-user"><i class="fa fa-eye"></i></button>
                            <button data-id="{{$user->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-user"><i class="fa fa-trash"></i></button>
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
    <div class="modal" id="delete-user" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Are you sure you want to delete ?</strong></h5>
                </div>
                <form action="/users/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="text" class="form-control" hidden id="user_id" name="user_id"></input>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success text-uppercase">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal" id="view-user" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary  text-center w-100"><strong>User Details</strong></h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10 col-lg-6">
                                <input type="text" readonly class="form-control-plaintext" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10 col-lg-6">
                                <input type="text" readonly class="form-control-plaintext" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Birthdate</label>
                            <div class="col-sm-10 col-lg-6">
                                <input type="text" readonly class="form-control-plaintext" name="dob" id="dob">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10 col-lg-6">
                                <input type="text" readonly class="form-control-plaintext" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10 col-lg-6">
                                <input type="text" readonly class="form-control-plaintext" name="address" id="address">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $('#delete-user').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('#user_id').val(id)
    })
    $('#view-user').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var name = button.data('name')
        var email = button.data('email')
        var dob = button.data('dob')
        var phone = button.data('phone')
        var address = button.data('address')
        var modal = $(this)
        modal.find('#name').val(name)
        modal.find('#email').val(email)
        modal.find('#dob').val(dob)
        modal.find('#phone').val(phone)
        modal.find('#address').val(address)
    })
</script>
@endpush