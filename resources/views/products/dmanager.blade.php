@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">    
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ route('device.edit') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('product.newDevice') }}</a>  
                </div>
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th class="capitalize center-align" style="width: 5%;">{{ trans('product.id') }}</th>
                            <th class="capitalize center-align" style="width: 15%;">{{ trans('product.key') }}</th>
                            <th class="capitalize center-align" style="width: 15%;">{{ trans('product.name') }}</th>
                            <th class="capitalize center-align" style="width: 50%;">{{ trans('product.values') }}</th>
                            <th class="capitalize center-align" style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $row)
                                <tr>

                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->code }}</td>
                                    <td>{{ $row->translate('es')->name }}</td>
                                    <td>{{ $row->str_values }}</td>
                                    <td>
                                        <a  href="{{ route('device.edit', [$row->id]) }}" 
                                            class="btn-floating waves-effect waves-light light-blue"><i class="mdi-content-create"></i></a>
                                        <form action="{{ url('/product/device/remove/'.$row->id) }}" method="POST" style="display: inline-block;margin-left: 10px;">
                                            {!! csrf_field() !!}
                                            <button class="btn-floating waves-effect waves-light" type="submit"><i class="mdi-content-clear"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="alert-info center-align">
                                    <h3>{{ trans('product.noResults') }}</h3>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection