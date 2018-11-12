@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col s12 m12 l12">
        <ul class="tabs z-depth-1" style="width: 100%;">
          <li class="tab col s3 light-blue darken-1">
            <a class="white-text waves-effect waves-light" href="#updateInformationStore">
              <i class="small mdi-maps-store-mall-directory"></i> <span class="hide-on-med-and-down">{{ trans('store.information_store') }} </span>
            </a>
          </li>
          <li class="tab col s3 light-blue darken-2">
            <a class="white-text waves-effect waves-light" href="#updateInformationAddress">
              <i class="small mdi-maps-directions"></i> <span class="hide-on-med-and-down">{{ trans('store.information_address') }} </span>
            </a>
          </li>
          <li class="tab col s3 light-blue darken-3">
            <a class="white-text waves-effect waves-light" href="#updateContact">
              <i class="small mdi-communication-quick-contacts-mail"></i> <span class="hide-on-med-and-down">{{ trans('store.contact') }}</span>
            </a>
          </li>
          <li class="tab col s3 light-blue darken-4">
            <a class="white-text waves-effect waves-light" href="#updateGPS">
              <i class="small mdi-communication-location-on"></i> <span class="hide-on-med-and-down">{{ trans('store.gps') }}</span>
            </a>
          </li>
        </ul>

        <form class="col s12" method="POST" action="{{ route('store.edit', [$data?$data->id:'']) }}" >
            {!! csrf_field() !!}
            <!-- updateInformationStore-->
            <div id="updateInformationStore" class="tab-content col s12  grey lighten-4">
                @include('store.partials.information_store')
            </div>

            <!-- updateInformationAddress -->
            <div id="updateInformationAddress" class="tab-content col s12  grey lighten-4" style="display: none;">
                @include('store.partials.information_address')
            </div>

            <!-- updateContact -->
            <div id="updateContact" class="tab-content col s12  grey lighten-4" style="display: none;">
                @include('store.partials.contact')
            </div>

            <!-- updateGPS -->
            <div id="updateGPS" class="tab-content col s12  grey lighten-4" style="display: none;">
                @include('store.partials.gps')
            </div>
        </form>
    </div>
</div>
    

@endsection

@section ('jsCustoms')
    @parent
    <script>

        function updateMap(){

            //updgrade map
            var latitude = Number("{{ isset($data->latitude)?$data->latitude:25.79584330 }}");
            var longitude = Number("{{ isset($data->longitude)?$data->longitude:-80.32878510 }}");
            console.log(latitude, longitude);
            deleteMarkers();
            map.setCenter(new google.maps.LatLng(latitude, longitude));
            var location = [{
                info: "{{ isset($data->name)?$data->name:'Yezz' }}",
                lat: latitude,
                lng: longitude,
                zIndex: 1
            }];
            addMultipleMarker(location);
        }
        
        if (document.readyState === "complete") {
            updateMap();
        } else {
            window.addEventListener("load", updateMap);
        }

        $( document ).ready(function() {

            $("input[name=is_chain]:checkbox").change(function () {
                if ($("input:checkbox[name='is_chain']:checked").val() == "on") {
                    $(".chainInformation").show('slow');
                } else {
                    $(".chainInformation").hide(500);
                }
            });
            //Update divs
            if ($("input:checkbox[name='is_chain']:checked").val() == "on") {
                $(".chainInformation").show('slow');
            } else {
                $(".chainInformation").hide(500);
            }

            var $route_states = "{{ route('search.states_by_country', ['URL']) }}";
            var $route_cities = "{{ route('search.cities_by_state', ['URL']) }}";
            var $route_townships = "{{ route('search.townships_by_city', ['URL']) }}";
            var $route_category = "{{ route('search.categories.data', ['URL']) }}";


            function formatOptions(html) {

                var options = "<option value=''></option>";
                var result = jQuery.parseJSON(html);

                for(var k in result) {
                    options += "<option value="+result[k]['id']+">"+ result[k]['text'] +"</option>" ;
                }

                return options;
            }

            //Update State and Cities list
            function asignValues(route, container, filter) {

                $.ajax({
                    type: "GET",
                    url: route.replace('URL', filter),
                    success: function(html) {
                        var options = formatOptions(html);
                        $("#"+container).html(options);
                        $("#"+container).material_select();
                    }
                });
            }

            $('#country_id').on("change", function () {
                asignValues($route_states, 'state_id', $('#country_id').val());
                $("#city_id").html("<option value=''></option>");
                $("#city_id").material_select();
                $("#township_id").html("<option value=''></option>");
                $("#township_id").material_select();
            });

            $('#state_id').on("change", function () {
                asignValues($route_cities, 'city_id', $('#state_id').val());
                $("#township_id").html("<option value=''></option>");
                $("#township_id").material_select();
            });

            $('#city_id').on("change", function () {
                asignValues($route_townships, 'township_id', $('#city_id').val());
            });

            $('#category_id').on("change", function () {
                $.ajax({
                    type: "GET",
                    url: $route_category.replace('URL', $('#category_id').val()),
                    success: function(html) {
                        var data = jQuery.parseJSON(html);
                        $('#category_description').val(data['description']);
                    }
                });
            });

        });
    </script>
@endsection
