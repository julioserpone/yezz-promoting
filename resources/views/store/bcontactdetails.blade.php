<div class="section">
    <div class="row">    
        <div class="col s10 offset-s1">
            <table class="striped">
                <thead>
                <tr>
                    <th colspan="2"><h3>{{ trans('store.client_data') }}</h3></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="capitalize">{{ trans('store.name') }}</th>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <th class="capitalize">{{ trans('store.surname') }}</th>
                        <td>{{ $data->surname }}</td>
                    </tr>
                    <tr>
                        <th class="capitalize">{{ trans('store.storeposition') }}</th>
                        <td>{{ $data->storeposition }}</td>
                    </tr>
                    <tr>
                        <th class="capitalize">{{ trans('store.phone') }}</th>
                        <td>{{ $data->phone }}</td>
                    </tr>
                    <tr>
                        <th class="capitalize">{{ trans('store.address') }}</th>
                        <td>{{ $data->address }}</td>
                    </tr>
                    <tr>
                        <th class="capitalize">{{ trans('store.email') }}</th>
                        <td>{{ $data->email }}</td>
                    </tr>                    
                    <tr>
                        <th class="capitalize">{{ trans('store.registrationDate') }}</th>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="capitalize">{{ trans('store.lastUpdate') }}</th>
                        <td>{{ $data->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>