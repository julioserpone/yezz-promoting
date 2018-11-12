@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <div class="row">
        <form class="col s12" method="POST" action="{{ url('/store/categoryEdit/'.($data?$data->id:'')) }}" >
          {!! csrf_field() !!}
          {{-- Account Data --}}
          <h4 class="header2">{{ trans('category.basicInformation') }}</h4>
          <div class="row">
            <div class="input-field col s6">
              <input type="text" name="name" 
              value="{{ \defValue::text(old(),$data,'name') }}">
              <label for="name" >{{ trans('category.name') }}</label>
              @include('errors.formElement',['label'=>'name'])
            </div>
            <div class="input-field col s6">
              <select name="status">
                <option value="1" {!! \defValue::select(old(),$data,'status',1) !!}>{{ trans('category.active') }}</option>
                <option value="0" {!! \defValue::select(old(),$data,'status',0) !!}>{{ trans('category.inactive') }}</option>
              </select>
              <label for="status">{{ trans('category.status') }}</label>
              @include('errors.formElement',['label'=>'status'])
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <textarea name="description" class="materialize-textarea">{{ \defValue::text(old(),$data,'description') }}</textarea>
              <label for="description">{{ trans('category.description') }}</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col m12">
              <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('category.send') }}
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