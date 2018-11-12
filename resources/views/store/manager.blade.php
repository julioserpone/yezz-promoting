@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">    
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ url('/store/storeEdit/') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('store.newStore') }}</a>  
                </div>
                <!--<table class="striped">-->
                <table id="datagrid" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>{{ trans('store.name') }}</th>
                            <th class="capitalize center-align">{{ trans('store.address') }}</th>
                            <th class="capitalize center-align"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->name }} ({{ $row->country->name }})</td>
                                    <td class="capitalize center-align">{{ $row->address }} / {{ $row->state->name }} / {{ $row->city->name }}</td>
                                    <td class="right">
                                        <div >
                                            <a  class="dropdown-button waves-effect waves-light btn blue" 
                                                href="#!" data-activates="storeDropdown{{ $row->id }}">
                                                {{ trans('store.actions') }}
                                                <i class="mdi-navigation-arrow-drop-down right"></i>
                                            </a>
                                            <ul id="storeDropdown{{ $row->id }}" class="dropdown-content">
                                              <li>
                                                <a class="modal-trigger default" href="#yezz-modal" modal-url="{{ url('/store/storeDetails/'.$row->id) }}">{{ trans('store.details') }} </a>
                                              </li>
                                              <li><a href="{{ url('store/storeEdit/'.$row->id) }}">{{ trans('store.edit') }}</a></li>
                                              @if (\Auth::user()->canDelete())
                                                  <li class="divider"></li>
                                                  <li>
                                                        <form action="{{ url('/store/removeStore/'.$row->id) }}"
                                                                method="POST">
                                                        {!! csrf_field() !!}
                                                        <button class="btn-flat" type="submit">
                                                            {{ trans('store.delete') }} 
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
                                <td colspan="6" class="alert-info center-align">
                                    <h3>{{ trans('store.noStore') }}</h3>
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