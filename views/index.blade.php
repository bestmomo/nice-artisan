@extends('NiceArtisan::template')

@section('content')

        <div id="collapse_item" class="panel-group">

          <?php $index = 0 ?>

          @foreach($items as $item)
              <div class="panel panel-info">
                <div class="panel-heading"> 
                  <h3 class="panel-title">
                    <a href="#item{{ ++$index }}" data-parent="#collapse_item" data-toggle="collapse">{{ $item->getName() . ' (' . $item->getDescription() . ')' }}</a> 
                  </h3>
                </div>
                <div id="item{{ $index }}" class="panel-collapse collapse">
                  <div class="panel-body"> 
                    <form method="POST" action="{!! url('niceartisan/item/' . $item->getName()) !!}">
                      {!! csrf_field() !!}
                      @if(count($item->getDefinition()->getArguments()) > 0)
                        <fieldset>
                            <legend>Arguments</legend>
                            <div class="form-group">
                                @foreach($item->getDefinition()->getArguments() as $argument)
                                    <label class="control-label">{{ $argument->getName() }}</label>
                                    <input type="text" class="form-control" name="argument_{{ $argument->getName() }}" placeholder="{{ $argument->getDefault() }}">
                                    <span class="help-block">{{ $argument->getDescription() }}</span>
                                @endforeach
                            </div>
                        </fieldset>
                      @endif
                      @if(count($item->getDefinition()->getOptions()) > 0)
                        <fieldset>
                            <legend>Options</legend>
                            <div class="form-group">
                              @foreach($item->getDefinition()->getOptions() as $option)
                                @if($option->getDefault() !== false)
                                  <label class="control-label">--{{ $option->getName() }}</label>
                                  <input type="text" class="form-control" name="option_{{ $option->getName() }}" placeholder="{{ is_array($option->getDefault()) ? '' : $option->getDefault() }}">
                                  <span class="help-block">{{ $option->getDescription() }}</span>
                                @else
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="option_{{ $option->getName() }}"> {{ $option->getDescription() }}
                                    </label>
                                  </div>
                                @endif
                              @endforeach
                            </div>
                        </fieldset>
                      @endif
                      <button type="submit" class="btn btn-info">Go !</button>
                    </form>                
                  </div>
                </div>
              </div>            
          @endforeach

        </div>

@endsection
