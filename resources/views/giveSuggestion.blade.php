@extends('layout')

@section('content')
    @if(Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="color:white">&times;</span>
            </button>
        </div>
    @endif
    <link rel="stylesheet" href="css/style.css">
{{--    <link rel="stylesheet" href="css/style.css">--}}
    <div class="col-sm-10" style="padding: 20px">
    <div class="">
        <header class="card-header-s">
            <h2 ><i class="fa fa-envelope" aria-hidden="true"></i>   Suggestion Box</h2>

        </header>
    </div>

    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="giveSuggestion" id="suggestion">
        {{@csrf_field()}}
        <div class="form-check-inline">
            <label class="form-check-label ">
                <input type="radio" class="form-check-input" name="optradio" value="Yes" onclick="myFunctionDisable()">Prefer to remain anonymous
            </label><br><br><br><br>
        </div>

        <div class="form-check-inline ">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" value="No" onclick="myFunctionEnable()">Prefer to be identified
            </label>
            <br><br>
        </div>
        <div>
            @error('optradio')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group ">
            <input type="text" class="form-control" name="names" id="names" placeholder="Enter your names" maxlength="40" >
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" maxlength="30" >
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone number" maxlength="15" >

        </div>
        <div class="form-group">
			<textarea class="form-control" id="suggestion" name="suggestion" placeholder="Write your Suggestion here..."  maxlength="2000" style="font-family: DejaVu Sans Mono, monospace;"></textarea><br>
            @error('suggestion')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <button class="btn btn-primary send-suggestionbtn" type="submit" id="" name="btnSendSuggestion" value=""><i class="fa fa-paper-plane" aria-hidden="true"></i>  Send a Suggestion</button>
        </div>
        <script  type="text/javascript">

            function myFunctionDisable() {
            var x = document.getElementById("names").disabled=true;
            var y=document.getElementById("telephone").disabled=true;
            var z=document.getElementById("email").disabled=true;
            }

            function myFunctionEnable() {
            var x = document.getElementById("names").disabled=false;
            var y=document.getElementById("telephone").disabled=false;
            var z=document.getElementById("email").disabled=false;
            }

        </script>

    </form>
    </div>

@stop

