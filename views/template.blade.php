<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nice Artisan</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .navbar-default {
                background-color: #598fb6;
                border-color: #2c777d;
            }
            .navbar-default .navbar-brand {
                color: #ebebe1;
            }
            .navbar-default .navbar-brand:hover, .navbar-default .navbar-brand:focus {
                color: #fcfbfe;
            }
            .navbar-default .navbar-text {
                color: #ebebe1;
            }
            .navbar-default .navbar-nav > li > a {
                color: #ebebe1;
            }
            .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
                color: #fcfbfe;
            }
            .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
                color: #fcfbfe;
                background-color: #2c777d;
            }
            .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
                color: #fcfbfe;
                background-color: #2c777d;
            }
            .navbar-default .navbar-toggle {
                border-color: #2c777d;
            }
            .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
                background-color: #2c777d;
            }
            .navbar-default .navbar-toggle .icon-bar {
                background-color: #ebebe1;
            }
            .navbar-default .navbar-collapse,
            .navbar-default .navbar-form {
                border-color: #ebebe1;
            }
            .navbar-default .navbar-link {
                color: #ebebe1;
            }
            .navbar-default .navbar-link:hover {
                color: #fcfbfe;
            }

            @media (max-width: 767px) {
                .navbar-default .navbar-nav .open .dropdown-menu > li > a {
                    color: #ebebe1;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
                    color: #fcfbfe;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
                    color: #fcfbfe;
                    background-color: #2c777d;
                }
            }
        </style>
    </head>

    <body>

        <div class="container">

            <br>

            <div class="container">

                <h1 class="text-center">Nice Artisan</h1>

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            @for ($i = 0; $i < count($options); $i++)
                                @if($i == 0)
                                    <li {!! request()->is('niceartisan') || request()->is('niceartisan/' . $options[$i]) ? 'class="active"' : '' !!}>
                                @else
                                    <li {!! request()->is('niceartisan/' . $options[$i]) ? 'class="active"' : '' !!}>
                                @endif
                                        <a href="{!! url('niceartisan/' . $options[$i]) !!}">{{ ucfirst($options[$i]) }}</a>
                                    </li>  
                            @endfor
                    </ul>
                </div>
            </nav>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('output'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success !</strong>
                    <br><br>
                    <pre>{!! session('output') !!}</pre>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error !</strong>
                    <br><br>
                    <pre>{!! session('error') !!}</pre>
                </div>
            @endif

            @yield('content')

        </div>

        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>