@extends('NiceArtisan::template')

@section('content')

        <ul class="collapsible popout" data-collapsible="accordion">
            @php
                $idIndex = 0;
            @endphp
            @foreach($items as $item)
                <li>
                    <div class="collapsible-header">{{ $item->getName() . ' (' . $item->getDescription() . ')' }}</div>
                    <div class="collapsible-body">
                        <div class="row">
                            <form  class="col s12" method="POST" action="{!! route('niceartisan.exec', ['class' => $item->getName()]) !!}">
                                {!! csrf_field() !!}
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
                                                    <input type="checkbox" id="id{{ ++$idIndex }}" name="option_{{ $option->getName() }}">
                                                    <label for="id{{ $idIndex }}">{{ $option->getDescription() }}</label>
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
