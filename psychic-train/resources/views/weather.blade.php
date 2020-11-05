<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="icon" href={{$condition['icon']}}>
    <title>Погода</title>
</head>
<body>

<div class="container">
    <form action="/weather">
        <label>
            <input type="date" name="date" onchange="submit();"
                   required value={{request()->date ?? \Carbon\Carbon::today()}}
                min={{\Carbon\Carbon::today()->addDays(-7)}}
                max={{\Carbon\Carbon::today()->addDay()}}>
        </label>
    </form>
    <h3>{{$name}}</h3>
    <p>Средняя температура за {{$date}}: {{$avgtemp_c}}°C</p>
    <p>
        {{$condition['text']}}
        <img src="{{$condition['icon']}}" alt="condition_icon">
    </p>
    <p>Маскимальная скорость ветра: {{$maxwind_kph}}км/ч</p>
</div>

</body>
</html>
