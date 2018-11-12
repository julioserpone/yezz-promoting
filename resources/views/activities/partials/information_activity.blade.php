    <div class="card-panel">
        {{-- Datos de la visita de la tienda --}}
        <h5>{{ trans('activities.information_activity') }}</h5>
        <div class="row">
    		<div class="input-field col s12">
    			<select id="branch_id" name="branch_id">
                    <option value=""></option>
                    @foreach($branchs as $key =>$value)
                        <option value="{{ $value->id }}" {!! \defValue::select(old(), $data, 'branch_id', $value->id) !!}>{{ $value->name }} ({{ $value->country->name }})</option>
                    @endforeach
                </select>
                <label>{{ trans('activities.branch') }}</label>
                @include('errors.formElement',['label'=>'branch_id'])
    		</div>
    		<div class="input-field col s12">
                <textarea name="comment" class="materialize-textarea">{{ \defValue::text(old(), $data, 'comment') }}</textarea>
                <label for="comment">{{ trans('activities.comments') }}</label>
                @include('errors.formElement',['label'=>'comment'])
            </div>
    	</div>
    	<div class="row">
    		<div class="input-field col s12">
    		</div>
    	</div>
    	<div class="row">
            <div class="input-field col m12">
                <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('store.send') }} <i class="mdi-content-send right"></i>
                </button>
            </div>
        </div>
    </div>