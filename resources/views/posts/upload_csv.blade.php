@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card bg-light mt-3">
        <div class="card-header">
            <strong>Upload CSV</strong>
        </div>
        <div class="card-body">
            <form action="{{route('upload_csv')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- <div class="form-group row">
                    <div class="col-xs-2">
                        <label for="ex1">col-xs-2</label>
                        <input class="form-control" id="ex1" type="text">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex2">col-xs-3</label>
                        <input class="form-control" id="ex2" type="text">
                    </div>
                    <div class="col-xs-4">
                        <label for="ex3">col-xs-4</label>
                        <input class="form-control" id="ex3" type="text">
                    </div>
                </div> -->
                <input type="file" name="csvfile" class="form-control">
                <br>
                <button class="btn btn-success" type="submit">Import Data</button>
            </form>
        </div>
    </div>
</div>
@endsection