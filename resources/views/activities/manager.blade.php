@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="right">
                    <a  href="{{ url('/activities/edit/') }}" class="btn waves-effect waves-light blue darken-4">
                    <i class="mdi-content-add"></i>&nbsp;{{ trans('activities.newActivity') }}</a>  
                </div>
                <table class="striped centered">
                    <thead>
                        <tr>
                            <th>{{ trans('activities.id') }}</th>
                            <th>{{ trans('activities.user') }}</th>
                            <th>{{ trans('activities.store') }}</th>
                            <th>{{ trans('activities.date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->count())
                            @foreach($data as $row)
                                <tr outside>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->user?$row->user->username:"" }}</td>
                                    <td>{{ $row->branch?$row->branch->name:"" }}</td>
                                    <td>{{ $row->created_at->format('Y-m-d h:i:s A') }}</td>
                                    <td class="right">
                                        @if($row->items->count())
                                        <button id="s-{{$row->id}}" class="waves-effect btn blue tr-show waves-light">{{ trans('activities.details') }}</button>
                                        <button id="h-{{$row->id}}" class="waves-effect btn blue tr-hide waves-light" style="display: none;">{{ trans('activities.hide') }}</button>
                                        @endif
                                        <a id="evidence-{{$row->id}}" class="waves-effect btn blue darken-3 waves-light modal-trigger" href="#yezz-modal" modal-url="{{ url('/getEvidence/').'/'.$row->id }}">{{ trans('activities.foto-evidence') }}</a>
                                    </td>
                                </tr>

                                @if($row->items->count())
                                    <tr style="display: none;">
                                        <td colspan="6">
                                            <div class="row">
                                                <table id="t-{{$row->id}}" class="col l12">
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
                                                @foreach($row->items as $subRow)
                                                    @continue(!$subRow)
                                                    @php $product=$subRow->product()->withTrashed()->first(); @endphp
                                                    @continue(!$product)
                                                    <tr>
                                                        <td>
                                                            <a class="waves-effect waves-light btn modal-trigger blue darken-3" href="#yezz-modal" modal-url="{{ route('product.show', [$subRow->product_id]) }}">{{ $product->name }}</a>
                                                        </td>
                                                        <td>{{ ($subRow->competence) ? $subRow->competence->name : '' }}
                                                            @if($subRow->competence)
                                                                @php $competence=$subRow->competence->withTrashed()->first(); @endphp
                                                            @endif
                                                        </td>
                                                        <td>{{ $subRow->stock }}</td>
                                                        <td>
                                                            @if($subRow->exhibition && $subRow->exhibition*1>0)
                                                                <a class="waves-effect waves-light btn modal-trigger blue darken-3" href="#yezz-modal" modal-url="{{ url('/getPhotoByLog/').'/'.$subRow->id }}">{{ $subRow->exhibition }}</a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $subRow->sale_price.' $' }}</td>
                                                        <td>{{ $subRow->sales.' UND' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="alert-info" style="text-align:center;"><h3>{{ trans('activities.noResults') }}</h3></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section("jsCustoms")
    <script type="text/javascript">
        $(document).ready(function () {
            $('table').on('click','button.tr-show',function () {
                $(this).hide("fast",function () {
                    $(this).next("button").show("fast");
                    $(this).parents("tr").next("tr").show("fast");
                });
            }).on('click','button.tr-hide',function () {
                $(this).hide("fast",function () {
                    $(this).prev("button").show("fast");
                    $(this).parents("tr").next("tr").hide("fast");
                });
            });
        });
    </script>
@endsection