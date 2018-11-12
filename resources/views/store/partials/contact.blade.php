    <div class="card-panel">
        {{-- Datos de Contacto --}}
        <h5>{{ trans('store.contactInformation') }}</h5>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="hidden" name="contact_id" id="contact_id" value="{{ (isset($data->contact) ? $data->contact->id : '') }}">
                <input type="text" name="name_customer" value="{{ \defValue::text(old(), (isset($data->contact) ? $data->contact : ''), 'name_customer') }}">
                <label for="name_customer" >{{ trans('store.name_customer') }}</label>
                @include('errors.formElement',['label'=>'name_customer'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="text" name="surname_customer" value="{{ \defValue::text(old(), (isset($data->contact) ? $data->contact : ''), 'surname_customer') }}">
                <label for="surname_customer" >{{ trans('store.surname_customer') }}</label>
                @include('errors.formElement',['label'=>'surname_customer'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="text" name="store_position_customer" value="{{ \defValue::text(old(), (isset($data->contact) ? $data->contact : ''), 'store_position_customer') }}">
                <label for="store_position_customer" >{{ trans('store.store_position_customer') }}</label>
                @include('errors.formElement',['label'=>'store_position_customer'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="text" name="phone_customer" value="{{ \defValue::text(old(), (isset($data->contact) ? $data->contact : ''), 'phone_customer') }}">
                <label for="phone_customer" >{{ trans('store.phone_customer') }}</label>
                @include('errors.formElement',['label'=>'phone_customer'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m6 l6">
                <input type="text" name="email_customer" value="{{ \defValue::text(old(), (isset($data->contact) ? $data->contact : ''), 'email_customer') }}">
                <label for="email_customer" >{{ trans('store.email_customer') }}</label>
                @include('errors.formElement',['label'=>'email_customer'])
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="text" name="address_customer" value="{{ \defValue::text(old(), (isset($data->contact) ? $data->contact : ''), 'address_customer') }}">
                <label for="address_customer" >{{ trans('store.address_customer') }}</label>
                @include('errors.formElement',['label'=>'address_customer'])
            </div>
        </div>
        <div class="row">
            <div class="input-field col m12">
                <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }} <i class="mdi-content-send right"></i>
                </button>
            </div>
        </div>  
    </div>