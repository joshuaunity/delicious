@extends('layouts.adminapp')
@section('contentadmin')
<h1>Categories </h1>

<form method="POST" action="" class="pt-3">
        @csrf
        <div class="row g-3 align-items-center">
                <div class="col-auto">
                        <input type="password" id="inputPassword6" class="form-control" placeholder="Name of category">
                </div>
                <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Add</button>
                </div>
        </div>
</form>

@endsection