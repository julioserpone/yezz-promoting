<div class="row">
	<div class="col m12">
		<div class="section">
			<h4>{{ trans('product.basicInformation') }}</h4>
			<p class="col m6"> 
				<strong>{{ trans('product.name') }}: </strong> {{ $data->name }}
			</p>
			<p class="col m6">
				<strong>{{ trans('product.number_part') }}:</strong> {{ $data->number_part }}
			</p>
		</div>
		
		<div class="section">
			<h4>{{ trans('product.phone_features') }}</h4>
			<a href="{{ route('product.edit', [$data->id]) }}" class="waves-effect waves-light btn blue darken-4">{{ trans('activities.updateProduct') }}</a>
			@php
				$features=$data->jsonFeatures;
				$count_row = 0;
			@endphp
			@foreach ($data->jsonFeatures as $key => $value)
				
				@if ($count_row == 0) 
				<div class="row">
				@endif
					<p class="col m6">
						<strong>{{ trans('product.'.$key) }}:</strong>
						{{ $value }}
					</p>
				
				@php ++$count_row @endphp
				@if ($count_row == 2)
					@php $count_row = 0 @endphp
				</div>
				@endif

			@endforeach
			
		</div>
	</div>
</div>