    <div class="card-panel">
        <div class="row">
            <div class="input-field col s6">
                <p>{{ trans('store.is_chain') }}</p>
            </div>

            <div class="input-field col s6 fix-pointer">
                <div class="switch">
                    <label>
                      No
                      <input type="checkbox" name="is_chain" id="is_chain" {{(isset($data->chain_id) && $data->chain_id != null) ? 'checked' : ''}}>
                      <span class="lever"></span>
                      Si
                    </label>
                </div>
            </div>
        </div>
        {{-- Informacion de la cadena de tienda --}}
        <div class="chainInformation">
            <div class="card-panel">
                <div class="row">
                    <h5>{{ trans('store.chainInformation') }}</h5>
                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <input type="text" name="name_chain" value="{{ \defValue::text(old(),(isset($data->chain) ? $data->chain : ''),'name_chain') }}">
                            <label for="name_chain" >{{ trans('store.name_chain') }}</label>
                            @include('errors.formElement',['label'=>'name_chain'])
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <input type="text" name="identification_chain" value="{{ \defValue::text(old(),(isset($data->chain) ? $data->chain : ''),'identification_chain') }}">
                            <label for="identification_chain" >{{ trans('store.icode_chain') }}</label>
                            @include('errors.formElement',['label'=>'identification_chain'])
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <select name="chain_country_id">
                                <option value=""></option>
                                @foreach($countries as $key =>$value)
                                    <option value="{{ $value->id }}" {!! \defValue::select(old(),(isset($data->chain) ? $data->chain : ''),'chain_country_id',$value->id) !!}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <label>{{ trans('store.country') }}</label>
                            @include('errors.formElement',['label'=>'chain_country_id'])
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <textarea name="address_chain" class="materialize-textarea">{{ \defValue::text(old(),(isset($data->chain) ? $data->chain : ''),'address_chain') }}</textarea>
                            <label for="address_chain">{{ trans('store.address_chain') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6 l6">
                            <input type="text" name="phone_chain" value="{{ \defValue::text(old(),(isset($data->chain) ? $data->chain : ''),'phone_chain') }}">
                            <label for="phone_chain" >{{ trans('store.phone_chain') }}</label>
                            @include('errors.formElement',['label'=>'phone_chain'])
                        </div>
                        <div class="input-field col s12 m6 l6">
                            <input type="text" name="email_chain" value="{{ \defValue::text(old(),(isset($data->chain) ? $data->chain : ''),'email_chain') }}">
                            <label for="email_chain" >{{ trans('store.email_chain') }}</label>
                            @include('errors.formElement',['label'=>'email_chain'])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Informacion de la tienda --}}
        <h5>{{ trans('store.basicInformation') }}</h5>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="text" name="name" value="{{ \defValue::text(old(), $data, 'name') }}">
                <label for="name" >{{ trans('store.name') }}</label>
                @include('errors.formElement',['label'=>'name'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="text" name="code" value="{{ \defValue::text(old(), $data, 'code') }}">
                <label for="code" >{{ trans('store.icode') }}</label>
                @include('errors.formElement',['label'=>'code'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="text" name="phone" value="{{ \defValue::text(old(), $data,'phone') }}">
                <label for="phone" >{{ trans('store.phone') }}</label>
                @include('errors.formElement',['label'=>'phone'])
            </div>
            <div class="input-field col s12 m6 l6">
                <select name="type_id">
                    <option value=""></option>
                    @foreach($type_channels as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'type_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                </select>
                <label>{{ trans('store.type_channel') }}</label>
                @include('errors.formElement',['label'=>'type_id'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <select id="category_id" name="category_id">
                    <option value=""></option>
                    @foreach($categories as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'category_id', $value->id) !!}>{{ $value->name }}</option>
                    @endforeach
                </select>
                <label>{{ trans('store.category') }}</label>
                @include('errors.formElement',['label'=>'category_id'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input class="validate" disabled type="text" id="category_description" name="category_description" value="{{ (isset($data->category_id)) ? $data->category->description : '' }}">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6 fix-pointer">
                <input type="checkbox" class="filled-in" name="is_customer" id="is_customer" {{(isset($data->is_customer) && $data->is_customer == 1) ? 'checked' : '' }} />
                <label for="is_customer">{{ trans('store.is_yezz') }}</label>
            </div>
            <div class="input-field col s12 m6 l6 fix-pointer">
                <input type="checkbox" class="filled-in" name="has_pop" id="has_pop" {{(isset($data->has_pop) && $data->has_pop == 1) ? 'checked' : '' }} />
                <label for="has_pop">{{ trans('store.has_pop') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12">
                <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }} <i class="mdi-content-send right"></i>
                </button>
            </div>
        </div>            
    </div>
                