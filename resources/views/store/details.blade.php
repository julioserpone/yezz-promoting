<div class="section">
    <div class="row">    
        <div class="col s12">
            <table class="striped">
                <tbody>
                    <tr>
                        <th class="capitalize">{{ trans('store.id') }}</th>
                        <td>
                            {{ $data->id }}
                            <div class="right">
                                <a  href="{{ url('store/storeEdit/'.$data->id) }}" 
                                    class="waves-effect waves-light btn blue darken-4">
                                    {{ trans('store.edit') }}
                                </a>
                                @if (\Auth::user()->canDelete())
                                    <form action="{{ url('/store/removeStore/'.$data->id) }}"
                                    method="POST" style="display: inline-block;">
                                        {!! csrf_field() !!}
                                        <button class="waves-effect waves-light btn" type="submit">{{ trans('store.delete') }}</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.icode') }}</th>
                        <td>{{ $data->code }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.name') }}</th>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.type_channel') }}</th>
                        <td>{{ $data->type_channel?$data->type_channel->translate('es')->name : trans('store.not_defined') }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.category') }}</th>
                        <td>{{ $data->category_id?$data->category->name : trans('store.not_defined') }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.address') }}</th>
                        <td>{{ $data->address }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.country') }}</th>
                        <td>{{ $data->country->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.state') }}</th>
                        <td>{{ $data->state->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.phone') }}</th>
                        <td>{{ $data->phone }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.is_yezz') }}</th>
                        <td>{{ ($data->is_customer) ? trans('store.yes') : trans('store.no') }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('store.chain') }}</th>
                        <td>{{ $data->chain_id ? $data->chain->name_chain : trans('store.not_defined') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>