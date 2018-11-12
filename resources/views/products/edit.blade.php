@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <div class="row">
          <form class="col s12" method="POST" action="{{ url('/product/edit/'.($data?$data->id:'')) }}" >
            {!! csrf_field() !!}
            <h4 class="header2">{{ trans('store.basicInformation') }}</h4>
            <div class="row">
              <div class="input-field col s12 m4 l4">
                <input type="text" id="brand" name="brand" class="autocomplete" value="{{ \defValue::text(old(),$data,'brand') }}">
                <label>{{ trans('product.brand') }}</label>
                @include('errors.formElement',['label'=>'brand'])
              </div>

              <div class="input-field col s12 m4 l4">
                <input type="text" id="model" name="model" class="autocomplete" value="{{ \defValue::text(old(),$data,'model') }}">
                <label>{{ trans('product.model') }}</label>
                @include('errors.formElement',['label'=>'model'])
              </div>

              <div class="input-field col s12 m4 l4">
                <input type="text" id="number_part" name="number_part" 
                value="{{ \defValue::text(old(),$data,'number_part') }}">
                <label>{{ trans('product.number_part') }}</label>
                @include('errors.formElement',['label'=>'number_part'])
              </div>
            </div>
            
            <h4 class="header2">{{ trans('product.phone_features') }}</h4>
            <div class="row">
              @foreach($features_list as $feature)
              <div class="input-field col s12 m4 l4">
                @if ($feature->type == 'opened')
                  <i class="{{ trans('product.arrayFeaturesIcons.'.$feature->code) }} prefix"></i>
                  <input type="text" pattern="\d+(\.\d{1})?" id="{{$feature->code}}" name="{{$feature->code}}" value="{{ \defValue::text(old(),($data ? $data->array_values: null),$feature->code) }}">
                  <label>{{ $feature->translate('es')->name }}</label>
                @else
                  <i class="{{ trans('product.arrayFeaturesIcons.'.$feature->code) }} prefix"></i>
                  <select id="{{$feature->code}}" name="{{$feature->code}}">
                    <option value=""></option>
                    @foreach($feature->array_values as $key => $value)
                    <option value="{{ $value }}" {!! \defValue::select(old(),($data ? $data->array_values : null),$feature->code,$value) !!}>{{ $value }}</option>
                    @endforeach
                  </select>
                  <label>{{ $feature->translate('es')->name }}</label>
                @endif
              </div>
              @endforeach
            </div>
            <div class="row">
              <div class="input-field col m12">
                <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }}
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('jsCustoms')
<script>

$(function() {
  $('#brand').autocomplete({
    data: {!! $brand !!},
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
  $('#model').autocomplete({
    data: {!! $model !!},
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });
});
$(document).ready(function() {
    $('select').material_select();
  });
</script>
@endsection