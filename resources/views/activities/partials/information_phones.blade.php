<div class="dinamic-list">    
    <div class="card-panel">
        {{-- Datos de los productos --}}
        <h5>{{ trans('activities.information_phones') }}</h5>
        <div class="row">
    		<div class="input-field col s8 m4 l4">
    			<select id="product_id" name="product_id">
                    <option value=""></option>
                    @foreach($products as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'product_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                </select>
                <label>{{ trans('activities.product') }}</label>
                @include('errors.formElement',['label'=>'product_id'])
                <input type="hidden" name="features" id="features" value="">
    		</div>
            <div class="input-field col s4 m2 l2">
                <a id="show_features" class="waves-effect waves-light btn modal-trigger blue darken-3 default" modal-url="" href="#yezz-modal">{{ trans('activities.more_info') }}</a>
            </div>
            <div class="input-field col s8 m4 l4">
                <select id="product_id_reference" name="product_id_reference">
                    <option value=""></option>
                    @foreach($products_yezz as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'product_id_reference', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                </select>
                <label>{{ trans('activities.product_reference') }}</label>
                @include('errors.formElement',['label'=>'product_id_reference'])
                <input type="hidden" name="features_yezz" id="features_yezz" value="">
            </div>
            <div class="input-field col s4 m2 l2">
                <a id="show_features_yezz" class="waves-effect waves-light btn modal-trigger blue darken-3 default" modal-url="" href="#yezz-modal">{{ trans('activities.more_info') }}</a>
            </div>
        </div>
        <div class="row">
        </div>
    	<div class="row">
    		<div class="input-field col s12 m4 l4">
                <input type="text" id="stock" name="stock" type="text" pattern="\d+(\.\d{1})?" value="{{ \defValue::text(old(), $data, 'stock') }}">
                <label for="stock" >{{ trans('activities.stock') }}</label>
                @include('errors.formElement',['label'=>'stock'])
            </div>
            <div class="input-field col s12 m4 l4">
                <input type="text" id="exhibition" name="exhibition" type="text" pattern="\d+(\.\d{1})?" value="{{ \defValue::text(old(), $data, 'exhibition') }}">
                <label for="exhibition" >{{ trans('activities.exhibition') }}</label>
                @include('errors.formElement',['label'=>'exhibition'])
            </div>
            <div class="input-field col s12 m4 l4">
                <input type="text" id="sales" name="sales" type="text" pattern="\d+(\.\d{1})?" value="{{ \defValue::text(old(), $data, 'sales') }}">
                <label for="sales" >{{ trans('activities.sales') }}</label>
                @include('errors.formElement',['label'=>'sales'])
            </div>
    	</div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="text" id="purchase_price" name="purchase_price" type="text" pattern="\d+(\.\d{1})?" value="{{ \defValue::text(old(), $data, 'purchase_price') }}">
                <label for="purchase_price" >{{ trans('activities.purchase_price') }}</label>
                @include('errors.formElement',['label'=>'purchase_price'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="text" id="sale_price" name="sale_price" type="text" pattern="\d+(\.\d{1})?" value="{{ \defValue::text(old(), $data, 'sale_price') }}">
                <label for="sale_price" >{{ trans('activities.sale_price') }}</label>
                @include('errors.formElement',['label'=>'sale_price'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12">
                <button class="btn light-blue darken-3 waves-effect waves-light right add" type="button">{{ trans('activities.load_to_list') }} <i class="mdi-content-archive right"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="card-panel">
        {{-- Productos Cargados --}}
        <h5>{{ trans('activities.phones_loaded') }}</h5>
        <script class="template-mirror" type="text/x-jQuery-tmpl">
            <input type="hidden" name="products_temp_list[]" id="products_temp_list[]" value="${product_id},${product_id_reference},${product},${product_reference},${stock},${sales},${exhibition},${purchase_price},${sale_price}">
        </script>
        <table id="container-list" class="striped centered">
            <thead>
                <tr>
                    <th class="capitalize center-align">{{ trans('activities.product') }}</th>
                    <th class="capitalize center-align">{{ trans('activities.product_reference') }}</th>
                    <th class="capitalize center-align">{{ trans('activities.stock_s') }}</th>
                    <th class="capitalize center-align">{{ trans('activities.sales_s') }}</th>
                    <th class="capitalize center-align">{{ trans('activities.exhibition_s') }}</th>
                    <th class="capitalize center-align">{{ trans('activities.purchase_price_s') }}</th>
                    <th class="capitalize center-align">{{ trans('activities.sale_price_s') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {{-- Aqui se imprimen los items agregados desde la lista --}}
                @php
                    $products_list = (old('products_list') ? : \Session::get('products_list'))
                @endphp
                @if ($products_list)
                    @foreach ($products_list as $key => $value)
                        <tr class="element r-ele-{{$key}}">
                            <td>{{ $value['product']}} </td>
                            <td>{{ $value['product_reference']}} </td>
                            <td class="center-align">{{ $value['stock']}} </td>
                            <td class="center-align">{{ $value['sales']}} </td>
                            <td class="center-align">{{ $value['exhibition']}} </td>
                            <td class="center-align">{{ $value['purchase_price']}} </td>
                            <td class="center-align">{{ $value['sale_price']}} </td>
                            <td class="center-align">
                                <input type="hidden" name="products_list[]" id="products_list[]" value="{{$value['product_id']}},{{$value['product_id_reference']}},{{$value['product']}},{{$value['product_reference']}},{{$value['stock']}},{{$value['sales']}},{{$value['exhibition']}},{{$value['purchase_price']}},{{$value['sale_price']}}" class="r-ele-{{$key}}">
                                <button type="button" class="btn-floating waves-effect waves-light remove"><i class="mdi-content-create"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <script class="template" type="text/x-jQuery-tmpl">
                    <tr>
                        <td>${product}</td>
                        <td>${product_reference}</td>
                        <td class="center-align">${stock}</td>
                        <td class="center-align">${sales}</td>
                        <td class="center-align">${exhibition}</td>
                        <td class="center-align">${purchase_price}</td>
                        <td class="center-align">${sale_price}</td>
                        <td class="center-align">
                            <input type="hidden" name="products_list[]" id="products_list[]" value="${product_id},${product_id_reference},${product},${product_reference},${stock},${sales},${exhibition},${purchase_price},${sale_price}">
                            <button type="button" class="btn-floating waves-effect waves-light remove"><i class="mdi-content-create"></i></button>
                        </td>
                    </tr>
                </script>
            </tbody>
        </table>
        <div id="mirror-container-list">
                {{-- falta cargar aqui la seccion del template para precargar los datos de la visita --}}
        </div>
    	<div class="row">
            <div class="input-field col m12">
                <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }} <i class="mdi-content-send right"></i>
                </button>
            </div>
        </div>
    </div>
</div>