@extends('layout')

@section('content')
    <div id="demo" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/transport.jpg" alt="transport" width="900" height="500">
                <div class="carousel-caption">
                    <h3>Transport</h3>
                    <p>For any further support you can contact us</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/ict.jpg" alt="ict" width="1100" height="500">
                <div class="carousel-caption">
                    <h3>ICT</h3>
                    <p>ICT Regulations</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/public_transportation.jpg" alt="New York" width="1100" height="500">
                <div class="carousel-caption">
                    <h3>Public transportation</h3>
                    <p>Buses</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
@stop
