@extends('layouts.app')

@section('content')

<div class="section">
    <div class="row">
        <div class="col s4 input-field">
            <select name="user_id" id="user_id">
                <option value="" disabled selected>{{ trans('localization.users') }}</option>
                    @foreach($users as $us)
                        <option value="{{ $us->id }}">{{ $us->person->first_name.' '.$us->person->last_name }}</option>
                    @endforeach
            </select>
            <label>{{ trans('localization.users') }}</label>
        </div>
        <div class="col s3 input-field">
            <input type="date" name="dates" id="dates" readonly id="dates" class="datepicker">
            <label for="dates">{{ trans('localization.date') }}</label>
        </div>
        <div class="col s3 input-field">
        </div>
        <div class="col s2 input-field">
        </div>
        <div class="col s12">
            <div id="map" style="display: block;height:700px;"></div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKot7eny0ZHLyBaAsnzJ1VC4NQ6XUwOmo"></script>
        <script src = "{{ asset('/js/app.js') }}" type="text/javascript"></script>
@endsection
@section('jsCustoms')
<script>
$(function() {
     //variables 
     var user = $('#user_id');
     var dates = $('#dates');
     var datepicker = $('.datepicker');

     //verifica los valores del formulario
     // y actualiza el mapa en caso de haber algun cambio
     function getData() {
         var id = user.val();
         var date = dates.val();

         if (id != null && date != null) {
             $.get('/store/map/hours/' + id + '/' + date, function(response) {
                 var select = '';
                 if (response.data) {
                     loc = formatJson(response.data);
                     deleteMarkers();
                     map.setCenter(new google.maps.LatLng(loc[0].lat, loc[0].lng));
                     addMultipleMarker(loc);
                 }
             });
         }
     }
     //configuracion datepicker
     datepicker.pickadate({
         format: 'yyyy-mm-dd',
         formatSubmit: 'yyyy-mm-dd',
         onSet: function(context) {},
         onClose: function(context) {
             getData();
         }
     });

     user.on('change', function() {
         getData();
     });
 });
</script>
@endsection
