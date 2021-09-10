@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"> 
                    <div class="card-header">Car list</div>
                        <div class="card-body">
                           <form action="{{route('car.index')}}" method="get">
                                <fieldset>
                                    <legend>Search</legend>
                                    <div class="block">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Search" name="s" value="{{$s}}">
                                            <small class="form-text text-muted">Search from cars.</small>
                                        </div>
                                    </div>
                                    <div class="block">
                                        <button type="submit" class="btn btn-info" name="search" value="all">Search</button>
                                        <a href="{{route('car.index')}}" class="btn btn-warning">Reset</a>
                                    </div>
                                </fieldset>
                            </form>
                               <div class="mb-3"> {{$cars->links()}}</div>
                            <ul class="list-group">
                                @foreach ($cars as $car)
                                <li class="list-group-item">
                                    <div class="list-block">
                                        <div class="list-block__content">
                                            <span><b>Name: </b>{{$car->name}} <i>Plate: </i>{{$car->plate}}</span>
                                            <small>{{$car->getMaker->name}} </small> 
                                        </div>
                                        <div class="list-block__buttons">
                                            <a href="{{route('car.edit',[$car])}}"class="btn btn-success">Edit</a>
                                            <a href="{{route('car.show',[$car])}}"class="btn btn-info">Show</a>
                                            <form  method="POST" action="{{route('car.destroy', [$car])}}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                          <div class="mt-3"> {{$cars->links()}}</div>
                    </div>
             
                </div>
            </div>
        </div>
    </div>
@endsection




