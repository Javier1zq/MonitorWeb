<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body class="antialiased">

        <div class="main-block">
        <h1>Address lookup</h1>
        <form action="searchFormAction" method="POST">
        @csrf
            <hr>
            <hr>
            <label id="icon" for="address"><i class="fas fa-envelope"></i></label>
            <input type="text" name="address" id="address" placeholder="address" required/>
            <hr>
            <div class="btn-block">

            <button type="submit" >Submit</button>
            </div>
        </form>
        </div>
        <ul>

        @if (!is_null($json))
            @foreach ($json['data'] as $item)
            <li>
                    {{print_r($item['label'], true)}}
            </li>
            @endforeach
        </ul>
        @endif
        <br><br><br><br>

        <form method="post" action="confirmAddress" >
        @csrf
            <select name="type">
            @if (!is_null($json))

                @foreach ($json['data'] as $item)
                        <option type="text" name="addressChosen" id="{{$item['townId']}}" placeholder="addressChosen" >{{print_r($item['label'], true)}}</option>
                @endforeach

            @endif
            </select>

            <label id="icon" for="number"><i class="fas fa-envelope"></i></label>
            <input type="text" name="number" id="number" placeholder="number" required/>

            <button type="submit" >Submit</button>
        </form>
    </body>
</html>
