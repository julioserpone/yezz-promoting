<!-- REQUIRED JS SCRIPTS -->

<script src = "{{ asset('/yezzclub-bower/jquery/dist/jquery.js') }}"></script>
<!--<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>-->

<!--<script src = "{{ asset('/js/materialize.backup.js') }}" type="text/javascript"></script>-->
<script src = "{{ asset('/plugins/materialize/js/bin/materialize.min.js') }}" type="text/javascript"></script>

<script src = "{{ asset('/yezzclub-bower/dropify/dist/js/dropify.js') }}" type="text/javascript"></script>
<!-- perfect-scrollbar v0.5.9 -->
<script src = "{{ asset('/yezzclub-bower/perfect-scrollbar/min/perfect-scrollbar.min.js') }}" type="text/javascript"></script>

<script src = "{{ asset('/yezzclub-bower/pnotify/dist/pnotify.js') }}" type="text/javascript"></script>
<script src = "{{ asset('/yezzclub-bower/pnotify/dist/pnotify.buttons.js') }}" type="text/javascript"></script>
<script src = "{{ asset('/yezzclub-bower/pnotify/dist/pnotify.animate.js') }}" type="text/javascript"></script>
<script src = "{{ asset('/yezzclub-bower/pnotify/dist/pnotify.desktop.js') }}" type="text/javascript"></script> 
<script src = "{{ asset('/yezzclub-bower/sweetalert/dist/sweetalert.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('/yezzclub-bower/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type = "text/javascript"></script>
<!--<script src = "{{ asset('/yezzclub-bower/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>-->
<!--<script src = "{{ asset('/yezzclub-bower/bootstrap3-typeahead/bootstrap3-typeahead.js') }}" type="text/javascript"></script>-->

<!-- Este script tiene unos ejemplos. Pero, al cargarlo, da error con la libreria chartist. Presumo que es porque aun no tengo ningun ID al cual aplicarle el grafico. EN REVISION -->
<!--<script src = "{{ asset('/js/plugins.min.js') }}" type="text/javascript"></script>-->
<script src = "{{ asset('/js/custom.js') }}" type="text/javascript"></script>
@section('jsCustoms')

@show