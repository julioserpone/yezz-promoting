@extends('layouts.app')

@section('content')

<div class="card-panel">

  <form class="col s12" method="POST" action="{{ url('/user/sectors/edit/'.($data?$data->id:'')) }}" >
    {!! csrf_field() !!}
    {{-- Account Data --}}
    <h4 class="header2">{{ trans('user_sector.basicInformation') }}</h4>
    <div class="row">
      <div class="input-field col s12">
        <select id="user_id" name="user_id">
          <option value=""></option>
            @foreach($users as $key =>$value)
            <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'user_id', $value->id) !!}>{{ $value->person->FullName }}</option>
            @endforeach
        </select>
        <label>{{ trans('user_sector.user') }}</label>
        @include('errors.formElement',['label'=>'user_id'])
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <select id="country_id" name="country_id">
          <option value=""></option>
            @foreach($countries as $key =>$value)
            <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'country_id', $value->id) !!}>{{ $value->name }}</option>
            @endforeach
        </select>
        <label>{{ trans('user_sector.country') }}</label>
        @include('errors.formElement',['label'=>'country_id'])
      </div>
      <div class="input-field col s6">
        <select id="state_id" name="state_id">
          <option value=""></option>
          @if ($states)
          @foreach($states as $key =>$value)
              <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'state_id', $value->id) !!}>{{ $value->name }}</option>
          @endforeach
          @endif
        </select>
        <label>{{ trans('user_sector.state') }}</label>
        @include('errors.formElement',['label'=>'state_id'])
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <select id="city_id" name="city_id">
            <option value=""></option>
            @if ($cities)
            @foreach($cities as $key =>$value)
                <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'city_id', $value->id) !!}>{{ $value->name }}</option>
            @endforeach
            @endif
        </select>
        <label>{{ trans('user_sector.city') }}</label>
        @include('errors.formElement',['label'=>'city_id'])
      </div>
      <div class="input-field col s6">
        <select id="township_id" name="township_id">
            <option value=""></option>
            @if ($townships)
            @foreach($townships as $key =>$value)
                <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'township_id', $value->id) !!}>{{ $value->name }}</option>
            @endforeach
            @endif
        </select>
        <label>{{ trans('user_sector.township') }}</label>
        @include('errors.formElement',['label'=>'township_id'])
      </div>
    </div>

    <div class="row">
      <div class="input-field col m12">
        <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('user_sector.send') }}
          <i class="mdi-content-send right"></i>
        </button>
      </div>
    </div>
  </form>

</div>

@endsection

@section ('jsCustoms')
    @parent

    <script>

        $( document ).ready(function() {

            var $route_states = "{{ route('search.states_by_country', ['URL']) }}";
            var $route_cities = "{{ route('search.cities_by_state', ['URL']) }}";
            var $route_townships = "{{ route('search.townships_by_city', ['URL']) }}";

            function formatOptions(html) {

                var options = "<option value=''></option>";
                var result = jQuery.parseJSON(html);

                for(var k in result) {
                    options += "<option value="+result[k]['id']+">"+ result[k]['text'] +"</option>" ;
                }

                return options;
            }

            //Update State and Cities list
            function asignValues(route, container, filter) {

                $.ajax({
                    type: "GET",
                    url: route.replace('URL', filter),
                    success: function(html) {
                        var options = formatOptions(html);
                        $("#"+container).html(options);
                        $("#"+container).material_select();
                    }
                });
            }

            $('#country_id').on("change", function () {
                asignValues($route_states, 'state_id', $('#country_id').val());
                $("#city_id").html("<option value=''></option>");
                $("#city_id").material_select();
                $("#township_id").html("<option value=''></option>");
                $("#township_id").material_select();
            });

            $('#state_id').on("change", function () {
                asignValues($route_cities, 'city_id', $('#state_id').val());
                $("#township_id").html("<option value=''></option>");
                $("#township_id").material_select();
            });

            $('#city_id').on("change", function () {
                asignValues($route_townships, 'township_id', $('#city_id').val());
            });
        });
    </script>
@endsection