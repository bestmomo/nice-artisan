<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Nice Artisan</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
        <style>
            .collapsible-flex {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .center-nav-links {
                display: flex;
                justify-content: center;
            }
        </style>
    
    </head>

    <body class="red darken-1">

        <div class="container"><br>

            <h1 class="center-align white-text">Nice Artisan</h1>
            @if(request()->has('search'))
                <h4 class="center-align z-depth-3" style="padding: 1rem">Results for "{{ request()->search }}"</h4><br>
            @endif
            <nav>
                <div class="nav-wrapper">
                  <form action="{{ route('niceartisan') }}" method="GET">
                    <div class="input-field">
                      <input id="search" name="search" type="search" placeholder="Search command" required>
                      <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                      <i class="material-icons">close</i>
                    </div>
                  </form>
                </div>
            </nav>

            <br>

            <nav class="nav-extended">
                <div class="nav-wrapper">
                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="hide-on-med-and-down center-nav-links">
                        {{-- First line --}}
                        @foreach (array_slice($options, 0, 8) as $key => $option)
                            @php
                                $isActive = false;
                                if (!request()->has('search')) {
                                    $urlMatchesOption = request()->is('niceartisan/' . $option);
                                    if ($key === 0) {
                                        if (request()->is('niceartisan') || $urlMatchesOption) {
                                            $isActive = true;
                                        }
                                    } else if ($urlMatchesOption) {
                                        $isActive = true;
                                    }
                                }
                            @endphp
                            <li class="{{ $isActive ? 'active' : '' }}">
                                <a href="{!! route('niceartisan', ['option' => $option]) !!}">
                                    {{ ucfirst($option) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="nav-wrapper hide-on-med-and-down">
                    <ul id="nav-mobile" class="center-nav-links">
                        {{-- Second line --}}
                        @foreach (array_slice($options, 8) as $option)
                            @php
                                $isActive = false;
                                if (!request()->has('search')) {
                                    if (request()->is('niceartisan/' . $option)) {
                                        $isActive = true;
                                    }
                                }
                            @endphp
                            <li class="tab {{ $isActive ? 'active' : '' }}">
                                <a href="{!! route('niceartisan', ['option' => $option]) !!}">
                                    {{ ucfirst($option) }}
                                </a>
                            </li>
                        @endforeach
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

            {{-- Preloader will be shown here when page reloads --}}
            <div id="preloader-container" class="center-align hide"><br><br>
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-red-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>     

            <div class="row"><br>

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
                      <div class="card green darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Success !</span>
                            <pre style="overflow-x: auto; white-space: pre;">
                                {!! session('output') !!}
                            </pre>                                                          
                        </div>
                      </div>
                    </div>    
                @endif

                @if (session('error'))
                    <div class="col s12">
                      <div class="card red accent-4">
                        <div class="card-content white-text">
                            <span class="card-title">Error !</span>
                            <pre style="overflow-x: auto; white-space: pre;">
                                {!! session('error') !!}
                            </pre>
                        </div>
                      </div>
                    </div>  
                @endif
                
            </div>

            @yield('content')

        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                M.AutoInit();

                // Get the preloader element
                const preloader = document.getElementById('preloader-container');

                // Get the forms
                const searchForms = document.querySelectorAll('form');
                
                // Get all navigation links
                const navLinks = document.querySelectorAll('#nav-mobile a, #mobile a');

                // Function to show the preloader and hide content
                function showPreloader() {
                    const contentToHide = document.querySelectorAll('.container > .row, .container > .collapsible, .container > .collection');
                    contentToHide.forEach(el => el.style.display = 'none');
                    preloader.classList.remove('hide');
                }

                // Attach event listener to the forms
                searchForms.forEach(form => {
                    form.addEventListener('submit', function(event) {
                        showPreloader();
                    });
                });           

                // Attach event listeners to all navigation links
                navLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        showPreloader();
                    });
                });

                const favButtons = document.querySelectorAll('.fav-btn');

                favButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();

                        const itemName = this.dataset.itemName;
                        let isFavorite = this.dataset.isFavorite === 'true';
                        const url = isFavorite
                            ? '/niceartisan/removefav/' + itemName
                            : '/niceartisan/addfav/' + itemName;
                        const newText = isFavorite ? 'Add to favorites' : 'Remove from favorites';
                        const newColorClass = isFavorite ? 'green lighten-1' : 'red lighten-1';
                        const oldColorClass = isFavorite ? 'red lighten-1' : 'green lighten-1';
                        const oldClassesToRemove = oldColorClass.split(' ');

                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                "X-Requested-With": "XMLHttpRequest"                          }
                        })
                        .then(response => {
                            if (response.ok) {
                                this.dataset.isFavorite = !isFavorite;
                                this.textContent = newText;
                                this.classList.remove(...oldClassesToRemove);
                                this.classList.add(...newColorClass.split(' '));
                            } else {
                                alert('An error occurred.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred.');
                        });
                    });
                });                
            });
        </script>

    </body>
</html>
