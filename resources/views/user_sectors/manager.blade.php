@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">    
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ route('user.sector.edit') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('user_sector.newUserSector') }}</a>  
                </div>
                <!--<table class="striped centered">-->
                <table id="datagrid" class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th class="capitalize center-align">{{ trans('user_sector.user') }}</th>
                            <th class="capitalize center-align">{{ trans('user_sector.country') }}</th>
                            <th class="capitalize center-align">{{ trans('user_sector.state') }}</th>
                            <th class="capitalize center-align">{{ trans('user_sector.city') }}</th>
                            <th class="capitalize center-align">{{ trans('user_sector.township') }}</th>
                            <th class="capitalize center-align"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $row)
                                <tr>

                                    <td>{{ $row->user->person->FullName }}</td>
                                    <td>{{ $row->country->name }}</td>
                                    <td>{{ ($row->state) ? $row->state->name : '' }}</td>
                                    <td>{{ ($row->city) ? $row->city->name : ''}}</td>
                                    <td>{{ ($row->township) ? $row->township->name : ''}}</td>
                                    <td class="right">
                                        <div>
                                            <a  class="dropdown-button waves-effect waves-light btn blue" 
                                                href="#!" data-activates="storeDropdown{{ $row->id }}">
                                                {{ trans('user_sector.actions') }}
                                                <i class="mdi-navigation-arrow-drop-down right"></i>
                                            </a>
                                            <ul id="storeDropdown{{ $row->id }}" class="dropdown-content">
                                              <li><a href="{{ route('user.sector.edit', [$row->id]) }}">{{ trans('user_sector.edit') }}</a></li>
                                              <li class="divider"></li>
                                              <li>
                                                    <form action="{{ url('/user/sectors/remove/'.$row->id) }}"
                                                            method="POST">
                                                    {!! csrf_field() !!}
                                                    <button class="btn-flat" type="submit">
                                                        {{ trans('user_sector.delete') }} 
                                                    </button>
                                                  </form>
                                              </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="alert-info center-align">
                                    <h3>{{ trans('user.noResults') }}</h3>
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