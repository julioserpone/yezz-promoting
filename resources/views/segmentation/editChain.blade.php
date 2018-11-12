@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <div class="row">
      <form class="col s12" method="POST" action="{{ url('/store/editChain/'.($data?$data->id:'')) }}" >
        {!! csrf_field() !!}
        {{-- Account Data --}}
        <h4 class="header2">{{ trans('segmentation.'.($data?'editChain':'newChain')) }}</h4>
        <div class="row">
          <div class="input-field col s12">
              <select name="segment">
                <option value=""></option>
                @foreach($segments as $row)
                <option value="{{ $row->id }}" {!! \defValue::select(old(),$data,['segment','segment_id'],$row->id) !!}>{{ $row->translate('es')->name }}</option>
                @endforeach
              </select>
              <label>{{ trans('segmentation.segment') }}</label>
            @include('errors.formElement',['label'=>'segment'])
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="text" name="name" 
            value="{{ \defValue::text(old(),$data,['name','description']) }}">
            <label for="name" class="">{{ trans('segmentation.nameChain') }}</label>
            @include('errors.formElement',['label'=>'name'])
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('segmentation.send') }}
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