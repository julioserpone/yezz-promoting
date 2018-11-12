@extends('layouts.app')

@section('content')
<div class="section">
    <div class="row">
        <div class="col s10 offset-s1">
            <div class="right">
                <a  href="{{ url('/store/categoryEdit/') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('category.newCategory') }}</a>
            </div>
            <table class="striped centered">
                <thead>
                    <tr>
                        <th class="capitalize center-align">{{ trans('category.id') }}</th>
                        <th class="capitalize center-align">{{ trans('category.title') }}</th>
                        <th class="capitalize center-align">{{ trans('category.status') }}</th>
                        <th class="capitalize center-align">{{ trans('category.description') }}</th>
                        <th class="capitalize center-align"></th>
                    </tr>
                </thead>
                <tbody>
                @if($data->count())
                    @foreach($data as $row)
                    <tr>

                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ ($row->status == 1) ? 'activa' : 'inactiva' }}</td>
                        <td>{{ $row->description }}</td>
                        <td class="right">
                            <div>
                                <a class="dropdown-button waves-effect waves-light btn blue" href="#!" data-activates="storeDropdown{{ $row->id }}">{{ trans('product.actions') }} <i class="mdi-navigation-arrow-drop-down right"></i></a>
                                <ul id="storeDropdown{{ $row->id }}" class="dropdown-content">
                                    <li><a href="{{ url('store/categoryEdit/'.$row->id) }}">{{ trans('product.edit') }}</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="alert-info center-align">
                            <h3>{{ trans('product.noResults') }}</h3>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col s10 offset-s1">{{ $data->links() }}</div>
    </div>
</div>
@endsection
