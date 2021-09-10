@extends('layouts.app')
   @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$car->name}}</div>
                    <div class="card-body">
                        <div class="cars-container">
                            <div class="cars-container__plate">
                                {{$car->name}} Plate: {{$car->plate}}
                            </div>
                            <div class="cars-container__about">
                                About: {!!$car->about!!}
                            </div>
                            <a href="{{route('car.pdf',[$car])}}"class="btn btn-info">PDF</a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    @endsection