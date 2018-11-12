<div class="row">
  <div class="col s12 m6 grid">
    @if ($data)
    <figure class="effect-zoe">
      <img src="{{ getenv('S3_FOLDER_BASE')}}{{ isset($data->path)?$data->path:'' }}" alt="img25">
      <figcaption>
      <h2>{{ $item->product->brand }} <span>{{ $item->product->model }}</span></h2>
      <p class="icon-links"></p>
      <p class="description"></p>
      </figcaption>
    </figure>
    @else
    <h4>{{ $item->product->brand }} <span>{{ $item->product->model }}</span></h4>
    <p>{{ trans('activities.noPhotos') }}</p>
    @endif
  </div>
</div>
@if (($data) && ($data->comments))
<div class="row">
  <p class="col m12">
    <strong>{{ trans('activities.comments') }}: </strong>&nbsp;
    {{  $data->comments }}
  </p>
</div>
<div class="divider"></div>
@endif
<div class="row">
  <p class="col m6">
    <strong>{{ trans('activities.stock') }}: </strong>{{ $item->stock }} {{ trans('activities.units') }}
  </p>
  <p class="col m6">
    <strong>{{ trans('activities.exhibition') }}: </strong>{{ $item->exhibition }} {{ trans('activities.units') }}
  </p>
</div>
<div class="divider"></div>
<div class="row">
  <p class="col m6">
    <strong>{{ trans('activities.sale_price') }}: </strong>{{ $item->sale_price.' $' }} 
  </p>
  <p class="col m6">
    <strong>{{ trans('activities.sales') }}: </strong>{{ $item->sales }} {{ trans('activities.units') }}
  </p>        
</div>