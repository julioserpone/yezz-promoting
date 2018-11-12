@extends('layouts.app')

@section('content')
<div class="row">
   <div class="col s12 m12 l12">
      <div class="card-panel">
         <div class="row">
            <form class="col s12" method="POST" action="{{ url('/product/device/edit/'.($data?$data->id:'')) }}" >
               {!! csrf_field() !!}
               
               <h4 class="header2">{{ trans('product.phone_features') }}</h4>
               <div class="row">
                  <div class="input-field col s6">
                     <input type="text" name="code" 
                     value="{{ \defValue::text(old(),$data,'code') }}">
                     <label>{{ trans('product.key') }}</label>
                     @include('errors.formElement',['label'=>'code'])
                  </div>
                  <div class="input-field col s6">
                     <select name="type">
                        <option value=""></option>
                        @foreach(trans('globals.type_feature') as $key =>$value)
                           <option value="{{ $key }}" {!! \defValue::select(old(),$data,'type',$key) !!}>{{ $value }}</option>
                        @endforeach
                     </select>
                     <label>{{ trans('product.type_feature') }}</label>
                     @include('errors.formElement',['label'=>'type'])
                  </div>
               </div>
               <div class="row">
                  @foreach(trans('locale') as $key =>$value)
                  <div class="input-field col s6">
                     <input type="text" name="name_{{$key}}" 
                     value="{{ \defValue::text(old(),$data?$data->translate($key):null,['name_'.$key,'name']) }}">
                     <label>{{ trans('product.name').' ('.$value.')' }}</label>
                     @include('errors.formElement',['label'=>'name_'.$key])
                  </div>
                  @endforeach
               </div>
               <div class="row">
                  <div class="col s5">
                     <h4 class="header2">{{ trans('product.posibles_values') }}</h4>
                     <h6 class="header2">{{ trans('product.noValuesDevices') }}</h6>
                  </div>
                  <div class="col s1">
                     <div id="clone" class="input-field col s2">
                        <a class="btn-floating btn waves-effect waves-light light-blue clone-content" 
                        clone-content="div.dummy.this-content"
                        remove-class="dummy,invisible"><i class="mdi-content-add"></i></a>
                     </div>
                  </div>
               </div>
               {{-- Dummy --}}
               <div class="row dummy this-content invisible">
                  @for($i=0;$i<5;$i++)
                     <div class="input-field col s2">
                        <input type="text" name="values[]">
                        <label>{{ trans('product.value') }}</label>
                     </div>
                  @endfor
                  <div class="input-field col s2">
                     <a class="btn-floating btn-large waves-effect waves-light remove-content" content="div.this-content"><i class="mdi-content-clear"></i></a>
                  </div>
               </div>        

               @include('errors.formElement',['label'=>'feature_values'])

               @if($data && $data->count() && $data->type == 'closed')
                     @php $i=0; @endphp
                     @foreach($data->array_values as $row)
                        @if($i==5) @php
                           $i=0;
                        @endphp @endif
                        @if($i==0)
                        <div class="row this-content">
                        @endif
                           <div class="input-field col s2">
                              <input type="text" name="values[]" value="{{ $row }}">
                              <label>{{ trans('product.value') }}</label>
                           </div>
                        @if($i++==4)
                           <div class="input-field col s2">
                              <a class="btn-floating btn-large waves-effect waves-light remove-content" content="div.this-content"><i class="mdi-content-clear"></i></a>
                           </div>
                        </div>
                        @endif
                     @endforeach

                     @if($i<5)
                        @for($i;$i<5;$i++)
                           <div class="input-field col s2">
                              <input type="text" name="values[]" value="">
                              <label>{{ trans('product.value') }}</label>
                           </div>
                        @endfor 
                        <div class="input-field col s2">
                           <a class="btn-floating btn-large waves-effect waves-light remove-content" content="div.this-content"><i class="mdi-content-clear"></i></a>
                        </div>
                     @endif
                  </div>
               @endif

               <div class="row">
                  <div class="input-field col m12">
                     <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }}<i class="mdi-content-send right"></i></button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
