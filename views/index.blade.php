@extends('NiceArtisan::template')

@section('content')

    <ul id="commandsList" class="collapsible popout" data-collapsible="accordion">
        @php
            $idIndex = 0;
        @endphp
        @foreach($items as $item)
            <li>
                <div class="collapsible-header collapsible-flex">
                    <span>{{ $item->getName() . ' (' . $item->getDescription() . ')' }}</span>
                    <a href="#" class="btn btn-small waves-effect waves-light fav-btn
                       @if($item->favorite) red lighten-1 @else green lighten-1 @endif"
                       data-item-name="{{ $item->getName() }}"
                       data-is-favorite="{{ $item->favorite ? 'true' : 'false' }}">
                        @if($item->favorite)
                            Remove from favorites
                        @else
                            Add to favorites
                        @endif
                    </a>
                </div>

                <div class="collapsible-body white">
                    <div class="row">
                        <form  class="col s12" method="POST" action="{!! route('niceartisan.exec', ['class' => $item->getName()]) !!}">
                            @csrf
                            <input type="hidden" name="command" value="{{ $item->getName() }}">
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
                                    @foreach($item->getDefinition()->getOptions() as $option)
                                        @if($option->getDefault() !== false)
                                            <div class="input-field">
                                                <input type="text" name="option_{{ $option->getName() }}" placeholder="{{ is_array($option->getDefault()) ? '' : $option->getDefault() }}">
                                                <label>--{{ $option->getName() . ' (' . $option->getDescription() }})</label>
                                            </div>
                                        @else
                                            <p>
                                                <label for="id{{ ++$idIndex }}">
                                                    <input type="checkbox" id="id{{ $idIndex }}" name="option_{{ $option->getName() }}">
                                                    <span>{{ $option->getDescription() }}</span>
                                                </label>
                                            </p>
                                        @endif
                                    @endforeach
                                </fieldset>
                            @endif
                            <br>
                            <div class="col s12 center-align">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Go !</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </li>
        @endforeach

    </ul>

@endsection
