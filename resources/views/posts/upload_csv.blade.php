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
                <div class="form-group row">
                    <div class="col-xs-2">
                        <input type="file" name="csvfile" class="form-control" accept=".csv">
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Import Data</button>

            </form>
        </div>
    </div>
</div>
@endsection