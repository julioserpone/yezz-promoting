@extends('layouts.app')

@section('content')
  <ul class="tabs .tabs-fixed-width">
    <li class="tab">
      <a class="white-text red darken-1 waves-effect waves-light" href="#channels">
      {{ trans('segmentation.channels') }}</a>
    </li>
    <li class="tab">
      <a class="white-text amber darken-1 waves-effect waves-light" href="#types">
      {{ trans('segmentation.types') }}</a>
    </li>
    <li class="tab">
      <a class="white-text light-blue darken-1 waves-effect waves-light active" href="#segments">
        {{ trans('segmentation.segments') }}</a>
    </li>
    <li class="tab">
      <a class="white-text cyan darken-1 waves-effect waves-light" href="#chains">
        {{ trans('segmentation.chains') }}</a>
    </li>
  </ul>
  <div class="row">
    <div class="col s12">
      <div id="channels" class="col s12 red lighten-5">
        <ol>
          @foreach($channels as $row)
            <li><h4>{{ $row->translate('es')->name }}</h4></li>
          @endforeach
        </ol>
      </div>
      <div id="types" class="col s12 amber lighten-5">
        <dl>
          @foreach($channels as $row)
            <dt><h4>{{ $row->translate('es')->name }}</h4></dt>
            @foreach($types->filter(function ($value,$key) use ($row)
            { return $value->channel_id==$row->id; })->all() as $subRow)
              <dd><h5>{{ $subRow->translate('es')->name }}</h5></dd>
            @endforeach
          @endforeach
        </dl>
      </div>
      <div id="segments" class="col s12 light-blue lighten-5">
          <table>
              <thead>
                  <tr>
                      <th class="capitalize center-align">{{ trans('segmentation.channels') }}</th>
                      <th class="capitalize center-align">{{ trans('segmentation.types') }}</th>
                      <th class="capitalize center-align">{{ trans('segmentation.segments') }}</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($segments as $row)
                  <tr> 
                    <td>
                      <label class="flow-text black-text">{{ 
                      $channels->first(function ($key, $value) use ($types,$row) {
                        return $value->id == $types->first(function ($key, $value) use ($row) {
                          return $value->id == $row->type_id;
                        })->channel_id;
                      })->translate('es')->name 
                    }}</label>
                    </td>
                    <td>
                      <label class="flow-text black-text">{{ 
                        $types->first(function ($key, $value) use ($row) {
                          return $value->id == $row->type_id;
                        })->translate('es')->name 
                      }}</label>
                    </td>
                    <td>
                      <label class="flow-text black-text">{{ $row->translate('es')->name }}</label>
                    </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
      </div>
      <div id="chains" class="col s12 cyan lighten-5">
          @include('segmentation.tableChains')
      </div>
    </div>
  </div>

@endsection