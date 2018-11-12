@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">    
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ route('product.edit') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('product.newProduct') }}</a>  
                </div>
                <!--<table class="striped centered">-->
                <table id="datagrid" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th class="capitalize center-align">{{ trans('product.id') }}</th>
                            <th class="capitalize center-align">{{ trans('product.number_part') }}</th>
                            <th class="capitalize center-align">{{ trans('product.brand') }}</th>
                            <th class="capitalize center-align">{{ trans('product.model') }}</th>
                            <th class="capitalize center-align"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $row)
                                <tr>

                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->number_part }}</td>
                                    <td>{{ $row->brand }}</td>
                                    <td>{{ $row->model }}</td>
                                    <td class="right">
                                        <div>
                                            <a  class="dropdown-button waves-effect waves-light btn blue" 
                                                href="#!" data-activates="productDropdown{{ $row->id }}">
                                                {{ trans('product.actions') }}
                                                <i class="mdi-navigation-arrow-drop-down right"></i>
                                            </a>
                                            <ul id="productDropdown{{ $row->id }}" class="dropdown-content">
                                              <li><a href="{{ route('product.edit', [$row->id]) }}">{{ trans('product.edit') }}</a></li>
                                              @if (\Auth::user()->canDelete())
                                                  <li class="divider"></li>
                                                  <li>
                                                        <form action="{{ url('/product/remove/'.$row->id) }}"
                                                                method="POST">
                                                        {!! csrf_field() !!}
                                                        <button class="btn-flat" type="submit">
                                                            {{ trans('product.delete') }} 
                                                        </button>
                                                      </form>
                                                  </li>
                                              @endif
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
    </div>
@endsection

@section('jsCustoms')

    @if($data->count())
    <script>
        $(function () {
            $(document).ready(function() {
                $('#datagrid').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });

                $('.dataTables_filter').addClass('left-align');
            });
        });
    </script>
    @endif
@endsection