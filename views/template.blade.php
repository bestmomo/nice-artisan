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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.8.1/github-markdown.min.css">
        <style>
            .center-nav-links {
                display: flex;
                justify-content: center;
            }
            /* SURCHARGE DES TABLEAUX POUR UN LOOK MATERIAL DESIGN */

            /* 1. Conteneur principal du tableau */
            #docs-content.markdown-body table {
                border-collapse: collapse;
                width: 100%;
                margin: 1.5em 0;
                /* Ajoute une ombre légère pour "élever" le tableau (Material Design) */
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                border-radius: 4px; /* Coins légèrement arrondis */
                overflow: hidden; /* Important pour que les coins arrondis fonctionnent bien */
            }

            /* 2. Cellules et entêtes */
            #docs-content.markdown-body th,
            #docs-content.markdown-body td {
                padding: 12px 15px;
                text-align: left;
                border: none; /* Supprime les bordures conflictuelles de GitHub CSS */
                /* Ligne de séparation horizontale douce */
                border-bottom: 1px solid #eeeeee;
            }

            /* 3. Style de l'en-tête du tableau (TH) */
            #docs-content.markdown-body th {
                /* Couleur d'arrière-plan Materialize douce (Teal Lighten-5) */
                background-color: #e0f2f1;
                color: #424242;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.9em;
            }

            /* 4. Retirer la ligne sous la dernière rangée pour une finition propre */
            #docs-content.markdown-body tr:last-child td {
                border-bottom: none;
            }
        </style>
    </head>

    <body class="red darken-1">

        <div class="container"><br>

            <h1 class="center-align white-text z-depth-2" style="padding-bottom: 7px">Nice Artisan</h1>
            @if(request()->has('search'))
                <h4 class="center-align z-depth-3" style="padding: 1rem">Results for "{{ request()->search }}"</h4><br>
            @endif
            <nav>
                <div class="nav-wrapper z-depth-2">
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

            <nav class="nav-extended ">
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
                                    @if($option == 'favorites') <i class="material-icons left">favorite</i> @else  @endif
                                    {{ ucfirst($option) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="nav-wrapper hide-on-med-and-down z-depth-2">
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
                            @if($options[$i] == 'favorites') <i class="material-icons left">favorite</i> @else  @endif
                            {{ ucfirst($options[$i]) }}
                        </a>
                    </li>
                @endfor
            </ul>

            {{-- Preloader will be shown here when page reloads --}}
            <div id="preloader-container" class="center-align hide"><br><br>
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-green-only">
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

                @if (isset($commandResult))
                    @if ($commandResult['type'] === 'success')
                        <div class="col s12">
                            <div class="card green darken-1">
                                <div class="card-content white-text">
                                    <span class="card-title">Success !</span>
                                    <small>Command: {{ $commandResult['command'] }} at {{ $commandResult['timestamp'] }}</small>
                                    <pre style="overflow-x: auto; white-space: pre-wrap;">{!! $commandResult['output'] !!}</pre>
                                </div>
                            </div>
                        </div>
                    @elseif ($commandResult['type'] === 'error')
                        <div class="col s12">
                            <div class="card red accent-4">
                                <div class="card-content white-text">
                                    <span class="card-title">Error !</span>
                                    <small>Command: {{ $commandResult['command'] }} at {{ $commandResult['timestamp'] }}</small>
                                    <pre style="overflow-x: auto; white-space: pre-wrap;">{!! $commandResult['error'] !!}</pre>
                                </div>
                            </div>
                        </div>
                    @endif
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
                    const inputFields = form.querySelectorAll('input[type="text"], input[type="checkbox"]');
                    inputFields.forEach(input => {
                        input.addEventListener('input', function() {
                            updateCommandPreview(form);
                        });
                        updateCommandPreview(form);
                    });
                });

                // Attach event listeners to all navigation links
                navLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        showPreloader();
                    });
                });

                // Copy command in clipboard
                const copyButtons = document.querySelectorAll('.copy-command-btn');
                copyButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const commandToCopy = this.getAttribute('data-clipboard-text');

                        if (navigator.clipboard) {
                            // Utilisation de l'API Clipboard moderne
                            navigator.clipboard.writeText(commandToCopy)
                                .then(() => {
                                    // Feedback visuel (Materialize Toast)
                                    M.toast({html: 'Command copied!', classes: 'green darken-1'});
                                })
                                .catch(err => {
                                    console.error('Copy error:', err);
                                    M.toast({html: 'Impossible to copy command.', classes: 'red darken-1'});
                                });
                        } else {
                            // Fallback pour les anciens navigateurs
                            const textArea = document.createElement("textarea");
                            textArea.value = commandToCopy;
                            document.body.appendChild(textArea);
                            textArea.focus();
                            textArea.select();
                            try {
                                document.execCommand('copy');
                                M.toast({html: 'Command copied! (Fallback)', classes: 'green darken-1'});
                            } catch (err) {
                                console.error('Copy error (Fallback):', err);
                                M.toast({html: 'Impossible to copy command.', classes: 'red darken-1'});
                            }
                            document.body.removeChild(textArea);
                        }
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

                /**
                 * Generate command artisan with form inputs
                 * @param {HTMLElement} formElement
                 * @returns {string}
                 */
                function generateCommand(formElement) {
                    let command = formElement.getAttribute('data-base-command');
                    const formData = new FormData(formElement);

                    for (const [key, value] of formData.entries()) {
                        if (key.startsWith('argument_') && value) {
                            command += ' ' + value.trim();
                        } else if (key.startsWith('option_')) {
                            const optionName = key.substring('option_'.length);
                            if (formElement.querySelector(`[name="${key}"][type="checkbox"]`)) {
                                const shortOptions = ['v', 'vv', 'vvv'];
                                command += shortOptions.includes(optionName) ? ` -${optionName}` : ` --${optionName}`;
                            } else if (value) {
                                command += ' --' + optionName + '="' + value.trim().replace(/"/g, '\\"') + '"';
                            }
                        }
                    }
                    return command;
                }

                /**
                 * Update command preview
                 * @param {HTMLElement} formElement
                 */
                function updateCommandPreview(formElement) {

                    const previewElement = formElement.querySelector('.command-output');
                    const copyButton = formElement.querySelector('.copy-command-btn');
                    if (previewElement && copyButton) {
                        const command = generateCommand(formElement);
                        previewElement.textContent = command;
                        copyButton.setAttribute('data-clipboard-text', command);
                    }
                }

            });

            // Manage documentation buttons click
            document.querySelectorAll('.docs-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    var commandName = this.getAttribute('data-command');
                    loadCommandDocumentation(commandName);
                });
            });

            function loadCommandDocumentation(commandName) {
                var progress = document.querySelector('#docs-modal .progress');
                var docsContent = document.getElementById('docs-content');

                progress.style.display = 'block';
                docsContent.innerHTML = '';
                document.getElementById('docs-modal-title').textContent = 'Documentation: ' + commandName;

                // Request AJAX
                fetch('/niceartisan/commands/' + commandName + '/docs', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Documentation not found');
                    }
                    return response.json();
                })
                .then(data => {
                    progress.style.display = 'none';
                    if (data.html) {
                        docsContent.innerHTML = data.html;
                    } else {
                        docsContent.innerHTML = '<p>No documentation available for this command.</p>';
                    }
                })
                .catch(error => {
                    progress.style.display = 'none';
                    docsContent.innerHTML = `
            <div class="card-panel red lighten-4 red-text">
                <i class="material-icons left">error</i>
                Error loading documentation: ${error.message}
            </div>
            `;
                });
            }
        </script>

    </body>
</html>
