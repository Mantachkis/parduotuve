@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Makers list</div>
                       <form action="{{route('maker.index')}}" method="get">
                            <fieldset class="field">
                                <legend>Sort</legend>
                                 <div class="block">
                                     <button type="submit" class="btn btn-info" name="sort" value="name">Name</button>
                                 </div>
                                <div class="block">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                            name="sort_dir" id="_1" 
                                            value="asc" @if('desc' != $sortDirection) checked @endif>
                                        <label class="form-check-label" for="_1">
                                        ASC
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                             name="sort_dir" id="_2"
                                             value="desc" @if('desc'== $sortDirection) checked @endif>
                                        <label class="form-check-label" for="_2">
                                         DESC
                                        </label>
                                    </div>
                                </div>
                                <div class="block">
                                    <a href="{{route('maker.index')}}" class="btn btn-danger">Reset</a>
                                </div>
                            </fieldset>
                        </form>
                    <div class="card-body">
                      <ul class="list-group">
                            <div class="mb-3"> {{$makers->links()}}</div>
                         @foreach ($makers as $maker)
                            <li class="list-group-item">
                                    <div class="list-block">
                                        <div class="list-block__content">
                                            <span>{{$maker->name}}</span>
                                            @if($maker->getCars->count())
                                                <small>Works on {{$maker->getCars->count()}} cars.</small>
                                            @else
                                            <small>Curently has no cars</small> 
                                            @endif
                                        </div>
                                        <div class="list-block__buttons">
                                            <a href="{{route('maker.edit',[$maker])}}" class="btn btn-success">Edit</a>
                                            <form method="POST" action="{{route('maker.destroy', $maker)}}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3"> {{$makers->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('title') Maker List @endsection

