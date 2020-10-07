@extends('layout')

@section('content')

   <h3>Add a staff a member</h3>
    <form method="POST" action="addStaff">
        {{@csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" id="names" name="names" placeholder="Names">
            @error('names')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="addStaff" name="addStaff" >Add Staff<i class='fa fa-send-o'></i></button>
        </div>
    </form>
@stop
