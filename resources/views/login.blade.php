@extends('layout')

@section('content')
    <div class="flex-center col-sm-8">
        <header class="header">
            <h3 style="text-align: center">Login here</h3>
        </header>
        <form class="justify-content-center" method="POST" action="login">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Login">
            </div>
        </form>
    </div>

@stop
