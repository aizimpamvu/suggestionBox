@extends('layout')

@section('content')
    <div>
        <header class="header">
            <h2 >Edit your Suggestion</h2>
        </header>
    </div>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="editSuggestion">
        {{@csrf_field()}}
        <input type="hidden"  name="id"  value="{{ $data->id }}"  >
        <div class="form-check-inline">
            <label class="form-check-label ">
                <input type="radio" class="form-check-input" name="optradio" value="{{ $data->anonymity }}" onclick="myFunctionDisable()">Prefer to remain anonymous
            </label>
        </div>

        <div class="form-check-inline ">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" value="{{ $data->anonymity }}" onclick="myFunctionEnable()">Prefer to be identified
            </label>
            @error('email')
            <span style="color:red">{{$message}}</span>
            @enderror
            <br><br>
        </div>

        <div class="form-group ">
            <input type="text" class="form-control" name="names" id="names"  value="{{ $data->names }}" placeholder="Enter your names" maxlength="40" >
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" id="email" value="{{$data->email}}" placeholder="Enter your Email" maxlength="30" >

        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="telephone" id="telephone" value="{{$data->telephone}}" placeholder="Telephone number" maxlength="15" >

        </div>
        <div class="form-group">
			<textarea class="form-control" name="suggestion" id="suggestion" value="" placeholder="Write your suggestion here...">{{$data->suggestion_details}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary " type="submit" name="btnSendSuggestion" value=""><i class="fas fa-angle-double-up"></i>Update Suggestion</button>
        </div>

    </form>
@stop
