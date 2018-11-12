@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ url('/activities/edit/') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('activities.newActivity') }}</a>  
                </div>
                <table id="datagrid" class="table table-bordered table-hover dataTable highlight">
                    <thead>
                        <tr>
                            <th class="center-align">{{ trans('activities.store') }}</th>
                            <th class="center-align">{{ trans('activities.date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $log_activity_branch)
                                <tr>
                                    <td>
                                        {{ $log_activity_branch->branch->name.' - '.$log_activity_branch->branch->country->name }}
                                        <div class="chip"><img src="{{ getenv('S3_FOLDER_BASE').$log_activity_branch->user->person->pic_url}}">{{ $log_activity_branch->user->username }}</div>
                                        @if($log_activity_branch->photo_evidences->count())
                                            <i class="mdi-image-camera-alt"></i>
                                        @endif
                                        @if($log_activity_branch->items->count())
                                            <i class="mdi-hardware-phone-android"></i>
                                        @endif
                                    </td>
                                    <td class="center-align">{{ $log_activity_branch->entry_time->format('Y-m-d h:i:s A') }}</td>
                                    <td class="right">
                                        <div>
                                            <a class="dropdown-button waves-effect waves-light btn blue" href="#!" data-activates="storeDropdown{{ $log_activity_branch->id }}">
                                                {{ trans('activities.actions') }} <i class="mdi-navigation-arrow-drop-down right"></i>
                                            </a>
                                            <ul id="storeDropdown{{ $log_activity_branch->id }}" class="dropdown-content">
                                              <li><a id="details-{{$log_activity_branch->id}}" class="modal-trigger default" href="#yezz-modal" modal-url="{{ route('activity.show_items', [$log_activity_branch->id]) }}">{{ trans('activities.details') }}</a></li>
                                              @if($log_activity_branch->photo_evidences->count())
                                                <li><a id="evidence-{{$log_activity_branch->id}}" class="modal-trigger default" href="#yezz-modal" modal-url="{{ route('activity.show_photo_evidences', [$log_activity_branch->id]) }}">{{ trans('activities.foto-evidence') }}</a></li>
                                              @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="alert-info" style="text-align:center;"><h3>{{ trans('activities.noResults') }}</h3></td>
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