@extends('layout')
@section('content')

    <div class="col-sm-8 ">

    <div class="header"style="text-align: center">
        <h3><i class="fas fa-address-card"></i> Register a New User</h3>
        @if(Session::get('user'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('user')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <form method="POST" action="register">
        @csrf
        <div class="form-group ">
            <label for="name">Names</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your names" maxlength="40" >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" maxlength="30" >

        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" maxlength="30" >

        </div>
{{--        <div class="form-group">--}}
{{--            <input type="re-password" class="form-control" name="password" id="password" placeholder="Enter your password" maxlength="30" >--}}

{{--        </div>--}}
        <div class="form-group">
            <label for="telephone">Phone number</label>
            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Enter Telephone number" maxlength="30" >

        </div>
        <div class="form-group">
            <button class="btn btn-primary " type="submit" name="register" value="">Register<i class='fas fa-location-arrow'></i></button>
        </div>
    </form>
    </div>
@stop
