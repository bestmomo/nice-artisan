<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
        <title>Nice Artisan</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    </head>

    <body>

        <div class="container">

            <br>

            <h1 class="center-align">Nice Artisan</h1>

            <nav>
                <div class="nav-wrapper">
                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="hide-on-med-and-down">
                        @for ($i = 0; $i < count($options); $i++)
                            @if($i == 0)
                                <li {!! request()->is('niceartisan') ||
                                        request()->is('niceartisan/' . $options[$i]) ?
                                        'class="active"' : '' !!}>
                            @else
                                <li {!! request()->is('niceartisan/' . $options[$i]) ?
                                        'class="active"' : '' !!}>
                            @endif
                                    <a href="{!! route('niceartisan', ['option' => $options[$i]]) !!}">
                                        {{ ucfirst($options[$i]) }}
                                    </a>
                                </li>
                        @endfor
                    </ul>
                </div>
            </nav>

            <ul class="sidenav" id="mobile">
                @for ($i = 0; $i < count($options); $i++)
                @if($i == 0)
                    <li {!! request()->is('niceartisan') ||
                            request()->is('niceartisan/' . $options[$i]) ?
                            'class="active"' : '' !!}>
                @else
                    <li {!! request()->is('niceartisan/' . $options[$i]) ?
                            'class="active"' : '' !!}>
                @endif
                        <a href="{!! route('niceartisan', ['option' => $options[$i]]) !!}">
                            {{ ucfirst($options[$i]) }}
                        </a>
                    </li>
                @endfor
            </ul>
            
            <div class="row">

                @if (isset($errors) && count($errors) > 0)
                    <div class="col s12">
                      <div class="card red accent-4">
                        <div class="card-content white-text">
                            <span class="card-title">Whoops !<small> There were some problems with your input.</small></span>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                      </div>
                    </div>  
                @endif

                @if (session('output'))
                    <div class="col s12">
                      <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Success !</span>
                            <pre>{!! session('output') !!}</pre>
                        </div>
                      </div>
                    </div>    
                @endif

                @if (session('error'))
                    <div class="col s12">
                      <div class="card red accent-4">
                        <div class="card-content white-text">
                            <span class="card-title">Error !</span>
                            <pre>{!! session('error') !!}</pre>
                        </div>
                      </div>
                    </div>  
                @endif
                
            </div>

            @yield('content')

        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <script>
            M.AutoInit();
        </script>

    </body>
</html>
