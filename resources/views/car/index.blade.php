@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit car</div>
                       <div class="card-body">
                            <ul class="list-group">
                                @foreach ($cars as $car)
                                <li class="list-group-item">
                                    <div class="list-block">
                                        <div class="list-block__content">
                                            <span><b>Name: </b>{{$car->name}} <i>Plate: </i>{{$car->plate}}</span>
                                            <small>{{$car->getMaker->name}} </small> 
                                        </div>
                                        <div class="list-block__buttons">
                                            <a href="{{route('car.edit',[$car])}}"class="btn btn-success">Edit</a></a>
                                            <form  method="POST" action="{{route('car.destroy', [$car])}}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




