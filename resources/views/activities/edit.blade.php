@extends('layouts.app')

@section('content')

@section('cssCustoms')
    <link href = "{{ asset('/yezzclub-bower/animate.css/animate.min.css') }}" rel = "stylesheet" type="text/css" />
@endsection

<div class="row">
    <div class="col s12 m12 l12">
        <ul class="tabs z-depth-1" style="width: 100%;">
            <li class="tab col s3 light-blue darken-1">
                <a class="white-text waves-effect waves-light" href="#updateInformationActivity">
                    <i class="small mdi-maps-store-mall-directory"></i> <span class="hide-on-med-and-down">{{ trans('activities.information_activity') }} </span>
                </a>
            </li>
            <li class="tab col s3 light-blue darken-2">
                <a class="white-text waves-effect waves-light" href="#updatePhones">
                    <i class="small mdi-hardware-phone-android"></i> <span class="hide-on-med-and-down">{{ trans('activities.information_phones') }} </span>
                </a>
            </li>
            {{-- <li class="tab col s3 light-blue darken-3">
                <a class="white-text waves-effect waves-light" href="#updateFotoEvidence">
                    <i class="small mdi-image-photo-camera"></i> <span class="hide-on-med-and-down">{{ trans('activities.information_evidences') }}</span>
                </a>
            </li> --}}
        </ul>

        <form class="col s12" method="POST" action="{{ route('activity.edit', [$data?$data->id:'']) }}" >
            {!! csrf_field() !!}
            <!-- updateInformationActivity-->
            <div id="updateInformationActivity" class="tab-content col s12  grey lighten-4">
                @include('activities.partials.information_activity')
            </div>

            <!-- updatePhones -->
            <div id="updatePhones" class="tab-content col s12  grey lighten-4" style="display: none;">
                @include('activities.partials.information_phones')
            </div>

            <!-- updateFotoEvidence -->
            {{-- <div id="updateFotoEvidence" class="tab-content col s12  grey lighten-4" style="display: none;">
                @include('activities.partials.information_evidences')
            </div> --}}

        </form>
    </div>
</div>

@endsection

@section ('jsCustoms')
    @parent
    <script src = "{{ asset('/yezzclub-bower/jquery-tmpl/jquery.tmpl.min.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('/js/jquery.repeter.js') }}" type="text/javascript"></script>
    <script>
        $(function ()
        {

            $('#stock').inputmask("999", {"placeholder": ""});
            $('#exhibition').inputmask("999", {"placeholder": ""});
            $('#sales').inputmask("999", {"placeholder": ""});
            $('#purchase_price').inputmask("999", {"placeholder": ""});
            $('#sale_price').inputmask("999", {"placeholder": ""});
            
            //Para agregar dinamicamente elementos a un div
            $('.dinamic-list').repeter({
                elements:{
                    //appendTo:'#container-list', 
                    allowDuplicated: false,
                    allowEdit: true,
                    itemVerify: 'product',
                    editSelector: 'products_list',
                    // options: 'table|item'    
                    //      all: any value a row or object
                    //      item:  index specific for a object
                    findByType: 'item',
                    tmplDataTempId: 'products_temp_list',   //Values loaded
                    tmplDataTempIndex: 2,                   //Index in values loaded
                    editValues: {
                        product_id: 0, 
                        product_id_reference: 1, 
                        stock: 4, 
                        sales: 5, 
                        exhibition: 6, 
                        purchase_price: 7, 
                        sale_price: 8
                    },
                    animation: 'animated bounceOutLeft',    //bounceOutRight = salida por la derecha
                    mirror:{
                        selector:'#mirror-container-list',
                        tmplSelector:'.template-mirror'
                    }
                },
                tmplData:function(){
                    var product_id=$('select[name="product_id"]').val();
                    var product = $("#product_id :selected").text();
                    var product_id_reference = $('select[name="product_id_reference"]').val();
                    var product_reference = $("#product_id_reference :selected").text();
                    var stock = $("#stock").val();
                    var sales = $("#sales").val();
                    var exhibition = $("#exhibition").val();
                    var purchase_price = $("#purchase_price").val();
                    var sale_price = $("#sale_price").val();

                    //Validar antes de insertar
                    if ((product != '') && (stock != '') && (sales != '') && (exhibition != '') && (sale_price != '')) {
                        return {product_id:product_id,product:product,product_id_reference:product_id_reference,product_reference:product_reference,stock:stock,sales:sales,exhibition:exhibition,purchase_price:purchase_price,sale_price:sale_price};
                    } else {
                        return {exit:true};
                    }
                }
            });

        });

        $( document ).ready(function() {

            var $route_products = "{{ route('search.products.data', ['URL']) }}";
            var $product_data = "{{ route('product.show', ['URL']) }}";

            function formatOptions(html) {

                var options = "<option value=''></option>";
                var result = jQuery.parseJSON(html);

                for(var k in result) {
                    options += "<option value="+result[k]['id']+">"+ result[k]['text'] +"</option>" ;
                }

                return options;
            }

            $('#product_id').on("change", function () {
                $.ajax({
                    type: "GET",
                    url: $route_products.replace('URL', $('#product_id').val()),
                    success: function(response) {
                        var data = jQuery.parseJSON(response);
                        var route = (data.length) ? $product_data.replace('URL', $('#product_id').val()) : '';
                        var brands = ['yezz','niu','parla'];

                        if (data.length) {
                            $("#show_features").attr("modal-url", route);
                            $("#features").val(JSON.stringify(data[0]['features']));

                            $("#product_id_reference").prop('selectedIndex', 0);

                            if (brands.includes(data[0]['brand'].toLowerCase())) {
                                $("#product_id_reference").prop('disabled', true);
                            } else {
                                $("#product_id_reference").prop('disabled', false);
                            }
                        } else {
                            $("#show_features").attr("modal-url", '');
                        }

                        //update select product reference
                        $("#product_id_reference").material_select();
                    }
                });
            });

            $('#product_id_reference').on("change", function () {
                $.ajax({
                    type: "GET",
                    url: $route_products.replace('URL', $('#product_id_reference').val()),
                    success: function(response) {
                        var data = jQuery.parseJSON(response);
                        var route = (data.length) ? $product_data.replace('URL', $('#product_id_reference').val()) : '';
                        if (data.length) {
                            $("#show_features_yezz").attr("modal-url", route);
                            $("#features_yezz").val(JSON.stringify(data[0]['features']));
                        } else {
                            $("#show_features_yezz").attr("modal-url", '');
                        }
                    }
                });
            });
        });
    </script>
@endsection
