<div class="row">
	<div class="col m12">
		<div class="section">
			<h4>{{ trans('activities.information_activity') }}</h4>
			<p class="col m12"> 
				<strong>{{ trans('activities.comments') }}: </strong> {{ ($data->comment) ? $data->comment : trans('activities.no-comments') }} 
			</p>
		</div>
	</div>

	@if($data->items->count())

	<table class="col l12">
		<thead>
			<tr>
				<th class="center-align">{{ trans('activities.product') }}</th>
				<th class="center-align">{{ trans('activities.competenceOf') }}</th>
				<th class="center-align">{{ trans('activities.stock_s') }}</th>
				<th class="center-align">{{ trans('activities.exhibition_s') }}</th>
				<th class="center-align">{{ trans('activities.sale_price_s') }}</th>
				<th class="center-align">{{ trans('activities.sales_s') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data->items as $subRow)
			@continue(!$subRow)
			@php $product=$subRow->product()->withTrashed()->first(); @endphp
			@continue(!$product)
			<tr>
				<td>
					<a class="waves-effect waves-light btn modal-trigger secundary blue darken-3" href="#yezz-modal-secundary" modal-url="{{ route('product.show', [$subRow->product_id]) }}">{{ $product->name }}</a>
				</td>
				<td>{{ ($subRow->competence) ? $subRow->competence->name : '' }}
					@if($subRow->competence)
					@php $competence=$subRow->competence->withTrashed()->first(); @endphp
					@endif
				</td>
				<td>{{ $subRow->stock }}</td>
				<td>
					@if($subRow->exhibition && $subRow->exhibition*1>0)
					<a class="waves-effect waves-light btn modal-trigger secundary blue darken-3" href="#yezz-modal-secundary" modal-url="{{ url('/getPhotoByLog/').'/'.$subRow->id }}">{{ $subRow->exhibition }}</a>
					@endif
				</td>
				<td>{{ $subRow->sale_price.' $' }}</td>
				<td>{{ $subRow->sales.' UND' }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
