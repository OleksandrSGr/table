<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Table</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            td {
                min-width: 70px;
            }
            .changed {
                color: orangered;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
    <form method="POST" action="/">
        {{ csrf_field() }}
        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th>#</th>
                @for ($i = 1; $i <= 100; $i++)
                    <th>{{$i}}</th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= 100; $i++)
                <tr>
                    <th scope="row">{{$i}}</th>
                    @for ($ii = 1; $ii <= 100; $ii++)
                        <td class="cell" id="{{$i}}x{{$ii}}" onclick="table.selectCell('{{$i}}x{{$ii}}')">0</td>
                    @endfor
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="form-group">
            <input type="button" class="btn btn-primary btn-block" onclick="table.push()" value="push">
        </div>
    </form>

    </body>
    <script src="js/table.js">

    </script>
</html>
