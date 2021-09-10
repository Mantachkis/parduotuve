<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$car->name}}</title>
</head>
<style>
    @font-face{
        font-family: 'Open Sans';
        src:url({{asset('fonts/OpenSans-Regular.ttf')}});
        font-weight:normal;
    }
    body{
         font-family: 'Open Sans';
    }
div{
    margin: 10px;
    padding: 10px;
}

</style>
<body>
    <h1>{{$car->name}}</h1>

    <div> <b>Car licence plate:</b>  {{$car->plate}}</div>
    <div><b>Car info:</b> {{$car->about}}</div>

</body>
</html>