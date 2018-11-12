@if(isset($label) && $errors->has($label))
	{{-- 
	<div class="errorTxt1">
		<div id="uname-error" class="error">
	        {{ $errors->first($label) }}
		</div>
	</div>
	 --}}
	 <div id="card-alert" class="card red">
      <div class="card-content white-text">
        <p>{{ $errors->first($label) }}</p>
      </div>
      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
@endif