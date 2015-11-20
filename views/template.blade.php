<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nice Artisan</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    </head>

    <body>

        <div class="container">

            <br>

            <h1 class="center-align">Nice Artisan</h1>

            <nav>
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
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
            
            <div class="row">

                @if (count($errors) > 0)
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
        
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

    </body>
</html>
