<!DOCTYPE html>
<html>

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<body>

    @include('layouts.partials.mainheader')

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            @include('layouts.partials.leftsidebar')

            <!-- START CONTENT -->
            <section id="content">

                @include('layouts.partials.contentheader')

                <!--start container-->
                <div class="container">

                    @yield('content')
    
                    {{-- @include('layouts.partials.floating_commands') --}}
                
                </div>

            </section> <!-- END CONTENT -->

            @include('layouts.partials.rightsidebar')

        </div> <!-- END WRAPPER -->
    </div> <!-- END MAIN -->

    @include('layouts.partials.footer')

    {{-- Modal --}}
    <div id="yezz-modal" class="modal modal-fixed-footer">
      <div class="modal-content">Titulo</div>
      <div class="modal-footer">
        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cerrar</a>
        {{-- <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a> --}}
      </div>
    </div>

    {{-- Modal Secundary --}}
    <div id="yezz-modal-secundary" class="modal modal-fixed-footer">
      <div class="modal-content">Titulo</div>
      <div class="modal-footer">
        <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cerrar</a>
        {{-- <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a> --}}
      </div>
    </div>

    <!-- JavaScripts -->
    @section('jsScripts')
        @include('layouts.partials.scripts')
    @show
    @if(session('msg'))
    <script type="text/javascript">
        $(document).ready(function () {
            swal({title: "{!! trans('globals.success_alert_title') !!}",   
                 text: "{!! session('msg') !!}",   
                 timer: 2000,   
                 type: "success" 
            });
        });
    </script>
    @endif
    @if(session('error'))
    <script type="text/javascript">
        $(document).ready(function () {
        swal({title: "{!! trans('globals.error_alert_title') !!}",   
                 text: "{!! session('error') !!}",   
                 timer: 2000,   
                 type: "error" 
            });
        });
    </script>
    @endif
</body>
</html>
