    <div class="card-panel">
        {{-- Direccion de la tienda --}}
        <h5>{{ trans('store.addressInformation') }}</h5>
        <div class="row">
    		<div class="input-field col s12 m6 l6">
        		<select id="country_id" name="country_id">
                    <option value=""></option>
                    @foreach($countries as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'country_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                </select>
                <label>{{ trans('store.country') }}</label>
                @include('errors.formElement',['label'=>'country_id'])
			</div>
            <div class="input-field col s12 m6 l6">
                <select id="state_id" name="state_id">
                    <option value=""></option>
                    @if ($states)
                    @foreach($states as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'state_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                    @endif
                </select>
                <label>{{ trans('store.state') }}</label>
                @include('errors.formElement',['label'=>'state_id'])
            </div>
		</div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <select id="city_id" name="city_id">
                    <option value=""></option>
                    @if ($cities)
                    @foreach($cities as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'city_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                    @endif
                </select>
                <label>{{ trans('store.city') }}</label>
                @include('errors.formElement',['label'=>'city_id'])
            </div>
            <div class="input-field col s12 m6 l6">
                <select id="township_id" name="township_id">
                    <option value=""></option>
                    @if ($townships)
                    @foreach($townships as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'township_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                    @endif
                </select>
                <label>{{ trans('store.township') }}</label>
                @include('errors.formElement',['label'=>'township_id'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <textarea name="address" class="materialize-textarea">{{ \defValue::text(old(), $data, 'address') }}</textarea>
                <label for="address">{{ trans('store.address') }}</label>
                @include('errors.formElement',['label'=>'address'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="text" name="zip_code" value="{{ \defValue::text(old(), $data, 'zip_code') }}">
                <label for="zip_code" >{{ trans('store.zip_code') }}</label>
                @include('errors.formElement',['label'=>'zip_code'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12">
                <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }} <i class="mdi-content-send right"></i>
                </button>
            </div>
        </div>  
    </div>
                