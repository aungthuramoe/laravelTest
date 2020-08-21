@extends('layouts.app')

@section('content')
<h1 class="mt-5 text-center text-success"> Hello Confirmation</h1>

<form action="" method="POST">
    @csrf
    <!-- <input type="hidden" name="name" value="Name">   
    <input type="hidden" name="email" value="Email">     
    <input type="hidden" name="password" value="Password">    -->

    <div>
        @foreach($data as $item)
        <h1 class="text-primary">My Data -> {{ $item }}</h1>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection