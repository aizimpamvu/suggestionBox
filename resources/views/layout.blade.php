<!doctype html>
<html lang="eng">
<head>
    <title>Suggestion Box</title>

    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <img class="navbar-brand" src="{{ asset('img/logorura.png') }}" alt="ruralogo">
{{--        <img  class="navbar-brand" src="img/logorura.png" alt="logo">--}}
        <a class="navbar-brand" href="/">Suggestion Box</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
{{--                <li class="nav-item active">--}}
{{--                    <a class="nav-link" href="/"><i class="fas fa-home"></i>Home <span class="sr-only">(current)</span></a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="/giveSuggestion" ><i class="fas fa-plus"></i>Give your Suggestion</a>
                </li>

                @if(auth()->check())

                        @can('manage-users')
                           @can('edit-users')
                            <li class="nav-item">
                                <a class="nav-link" href="/list" ><i class="fa fa-list" aria-hidden="true" ></i>Suggestions</a>
                            </li>

                            @endcan
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbardrop"php
                                       data-toggle="dropdown" href="#"><i class="fa fa-wrench" aria-hidden="true"></i> Setting</a>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="/usersManagement" ><i class="fas fa-users"></i> Users</a>

                                        <a class="dropdown-item " href="/addDepartment" id="departments" ><i class="fa fa-link" aria-hidden="true"></i> Departments</a>
                                        <a class="dropdown-item " href="/units" id="units" >Units</a>
                                        {{--                        <a class="dropdown-item " href="/units" id="precedence" >U</a>--}}

                                    </div>
                                </li>

                        @endcan


                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(auth()->check())
                    <form action="{{ route('logout') }}" method="post" id="logoutForm">@csrf</form>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" href="#">Welcome| {{ auth()->user()->names }}</a>

                        <div class="dropdown-menu">

                            <a class="dropdown-item"href="{{ route('suggestion.assignedToMe',auth()->id()) }}" data-toggle="tooltip" data-placement="top" title="Click here to check suggestion assigned to me"><i class="fa fa-bell" aria-hidden="true"></i>Assigned to me</a>

                            <a class="btn-outline-danger dropdown-item " href="" id="logoutLink" data-toggle="tooltip" data-placement="bottom" title="Click here to Logout">
                            <i class="fas fa-sign-out-alt"></i>Logout
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/register"> <i class="fa fa-user" aria-hidden="true"></i>Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/login"><i class="fas fa-sign-in-alt"></i>Login</a>
                    </li>
                @endif
            </ul>

        </div>
    </nav>
</header>
<div class="container" style="padding: 30px" >
    @yield('content')

</div>
<div class="panel-footer">
    <footer>

        <div style="text-align: center;padding-top:30px;">
            <hr>
            <p>© 2020 Rwanda Utilities Regulatory Authority. All rights reserved. </p>
        </div>
    </footer>
</div>



<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@yield('script')

<script>
    //Logout
    $(function(){
       $('#logoutLink').on('click',function(e){
           e.preventDefault();
           $('#logoutForm').submit();
       })
    });
//Tooltip

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>
</html>
