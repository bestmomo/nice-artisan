@extends('NiceArtisan::template')

@section('content')

    <!-- Modal for documentation -->
    <div id="docs-modal" class="modal modal-fixed-footer" style="max-width: 90%; width: 90%; max-height: 85%; height: 85%;">
        <div class="modal-content markdown-body" style="padding: 0;">
            <div class="modal-header" style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                <h4 id="docs-modal-title" style="margin: 0;">Documentation</h4>
            </div>
            <div id="docs-modal-content" style="padding: 20px; height: calc(100% - 80px); overflow-y: auto;">
                <div class="progress" style="display: none;">
                    <div class="indeterminate"></div>
                </div>
                <div id="docs-content"></div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </div>

    <ul id="commandsList" class="collapsible popout" data-collapsible="accordion">
        @if($option == 'history')
            <div class="row">
                <div class="col s12">
                    <ul class="collection">
                        @foreach($itemsHistory as $historyCommand)
                            <li class="collection-item">
                                <div>
                                    {{ $historyCommand['full_command'] }}
                                    <a
                                        href="{!! route('niceartisan.replay', ['id' => $historyCommand['id']]) !!}"
                                        class="tooltipped secondary-content" data-tooltip="Re-run the command">
                                        <i class="material-icons">refresh</i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row center-align">
                <a
                    href="{{ route('niceartisan.cleanHistory') }}"
                    class="waves-effect waves-light btn red tooltipped"
                    data-tooltip="History keeps the 10 last commands">
                    <i class="material-icons left">delete</i>
                    Clean history
                </a>
            </div>
        @else
            @if($option == 'favorites' && empty($items))
                <div class="row">
                    <div class="card teal z-depth-2">
                        <div class="card-content white-text center-align">
                            <p>You do not have any favorite command yet.</p><br>
                            <p>You can create them by using the “ADD TO FAVORITES” button for each command.</p><br>
                            <p>Similarly, you can remove them using the “REMOVE FROM FAVORITES” button.</p>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $idIndex = 0;
                @endphp
                @foreach($items as $item)
                    <li>
                        <div class="collapsible-header z-depth-2">
                            <span style="flex: 1; margin-right: 15px;">{{ $item->getName() . ' (' . $item->getDescription() . ')' }}</span>
                            <div style="display: flex; gap: 8px; flex-shrink: 0;">
                                <a href="#" class="btn btn-small waves-effect waves-light fav-btn
                                   @if($item->favorite) red lighten-1 @else green lighten-1 @endif"
                                   data-item-name="{{ $item->getName() }}"
                                   data-is-favorite="{{ $item->favorite ? 'true' : 'false' }}"
                                   data-tooltip="@if($item->favorite) Remove from favorites @else Add to favorites @endif"
                                   style="display: flex; align-items: center; justify-content: center;">
                                    @if($item->favorite)
                                        Remove from favorites
                                    @else
                                        Add to favorites
                                    @endif
                                </a>
                            </div>
                        </div>

                        <div class="collapsible-body white">
                            <div class="row">
                                <form class="col s12" method="POST" action="{!! route('niceartisan.exec', ['class' => $item->getName()]) !!}" data-base-command="php artisan {{ $item->getName() }}">
                                    @csrf
                                    <input type="hidden" name="command" value="{{ $item->getName() }}">
                                    <input id="previewInput" type="hidden" name="preview" value="php artisan {{ $item->getName() }}">

                                    <div class="col s12 command-preview-container" style="margin-bottom: 20px;">
                                        <div class="card-panel grey darken-4 white-text command-output" style="word-break: break-all;">
                                            php artisan {{ $item->getName() }}
                                        </div>
                                        @if($item->doc)
                                            <button
                                                data-target="docs-modal"
                                                class="btn btn-small modal-trigger blue lighten-1 docs-btn tooltipped"
                                                data-tooltip="View documentation"
                                                data-command="{{ $item->getName() }}">
                                                <i class="material-icons">menu_book</i>
                                            </button>
                                        @endif
                                        <button type="button" class="btn waves-effect waves-light copy-command-btn" data-clipboard-text="" style="float: right;">
                                            <i class="material-icons left">content_copy</i> Copy command
                                        </button>
                                    </div>

                                    @if(count($item->getDefinition()->getArguments()) > 0)
                                        <fieldset>
                                            <legend>Arguments</legend>
                                            @foreach($item->getDefinition()->getArguments() as $argument)
                                                <div class="input-field">
                                                    <input type="text" name="argument_{{ $argument->getName() }}" placeholder="{{ is_array($argument->getDefault()) ? '' : $argument->getDefault() }}">
                                                    <label>{{ $argument->getName() . ' (' . $argument->getDescription() }})</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    @endif
                                    @if(count($item->getDefinition()->getOptions()) > 0)
                                        <fieldset>
                                            <legend>Options</legend>
                                            @foreach($item->getDefinition()->getOptions() as $opt)
                                                @if($opt->getDefault() !== false)
                                                    <div class="input-field">
                                                        <input type="text" name="option_{{ $opt->getName() }}" placeholder="{{ is_array($opt->getDefault()) ? '' : $opt->getDefault() }}">
                                                        <label>--{{ $opt->getName() . ' (' . $opt->getDescription() }})</label>
                                                    </div>
                                                @else
                                                    <p>
                                                        <label for="id{{ ++$idIndex }}">
                                                            <input type="checkbox" id="id{{ $idIndex }}" name="option_{{ $opt->getName() }}">
                                                            <span>{{ $opt->getDescription() }}</span>
                                                        </label>
                                                    </p>
                                                @endif
                                            @endforeach
                                        </fieldset>
                                    @endif
                                    @if(!empty($globalOptions))
                                        <fieldset>
                                            <legend>Global options</legend>
                                            @foreach($globalOptions as $globalOption)
                                                @if($globalOption['type'] === 'checkbox')
                                                    <p>
                                                        <label>
                                                            <input type="checkbox" name="option_{{ $globalOption['name'] }}">
                                                            <span>{{ $globalOption['name'] }} ({{ $globalOption['description'] }})</span>
                                                        </label>
                                                    </p>
                                                @elseif($globalOption['type'] === 'text')
                                                    <div class="input-field">
                                                        <input type="text" name="option_{{ $globalOption['name'] }}">
                                                        <label>--{{ $globalOption['name'] }} ({{ $globalOption['description'] }})</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </fieldset>
                                    @endif
                                    <br>
                                    <div class="col s12 center-align">
                                        <button class="btn waves-effect waves-light" type="submit">Go !</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
            @if($option == 'favorites' && !empty($items))
                <br>
                <div class="row center-align">
                    <a
                        href="{{ route('niceartisan.cleanFavorites') }}"
                        class="waves-effect waves-light btn red">
                        <i class="material-icons left">delete</i>
                        Clean all favorites
                    </a>
                </div>
            @endif
        @endif
    </ul>

@endsection
