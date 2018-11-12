@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ url('/store/branchEdit/') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('store.newBranch') }}</a>  
                </div>
                <table class="striped">

                    <thead>
                        <tr>
                            <th class="capitalize center-align">{{ trans('store.id') }}</th>
                            <th class="capitalize center-align">{{ trans('store.store') }}</th>
                            <th class="capitalize center-align">{{ trans('store.reference') }}</th>
                            <th class="capitalize center-align">{{ trans('store.icode') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->store?$row->store->name:"" }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->code }}</td>
                                    <td class="right">
                                        <div>
                                            <a  class="dropdown-button waves-effect waves-light btn blue" 
                                                href="#!" data-activates="branchDropdown{{ $row->id }}">
                                                {{ trans('store.actions') }}
                                                <i class="mdi-navigation-arrow-drop-down right"></i>
                                            </a>
                                            <ul id="branchDropdown{{ $row->id }}" class="dropdown-content">
                                                <li><a  class="modal-trigger" href="#yezz-modal" 
                                                    modal-url="{{ url('/store/branchDetails/'.$row->id) }}">{{ trans('store.details') }}
                                                </a></li>
                                                @if($row->contact)
                                                <li><a  class="modal-trigger" href="#yezz-modal" 
                                                    modal-url="{{ url('/store/branchContactDetails/'.$row->contact->id) }}">{{ trans('store.contact') }}
                                                </a></li>
                                                @endif
                                                @if($row->store)
                                                <li><a  class="modal-trigger" href="#yezz-modal" 
                                                    modal-url="{{ url('/store/storeDetails/'.$row->store_id) }}">{{ trans('store.store') }}
                                                </a></li>
                                                @endif
                                                <li><a href="{{ url('/table/activities').'?branch='.$row->id }}">{{ trans('store.viewActivities') }}</a></li>
                                                <li><a href="{{ url('/construction').'?branch='.$row->id }}">{{ trans('store.viewProducts') }}</a></li>
                                                <li class="divider"></li>
                                                <li><a href="{{ url('store/branchEdit/'.$row->id) }}">{{ trans('store.edit') }}</a></li>
                                                <li class="divider"></li>
                                                <li>
                                                    <form action="{{ url('/store/removeBranch/'.$row->id) }}"
                                                            method="POST">
                                                    {!! csrf_field() !!}
                                                    <button class="btn-flat" type="submit">
                                                        {{ trans('store.delete') }} 
                                                    </button>
                                                  </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>                                    
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9" class="alert-info center-align">
                                <h3>{{ trans('store.noBranch') }}</h3>
                            </td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col s10 offset-s1">{{ $data->links() }}</div>
            </div>
        </div>  
    </div>
@endsection