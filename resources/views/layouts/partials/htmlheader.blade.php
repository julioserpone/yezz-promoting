<head>
    <meta charset="UTF-8">
    <title>{{ trans('globals.app_title') }} @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Font Awesome Icons -->
    <!--<link href = "{{ asset('/yezzclub-bower/components-font-awesome/css/font-awesome.min.css') }}" rel = "stylesheet" type = "text/css" />-->

    <!-- Ionicons -->
    <!--<link href = "{{ asset('/yezzclub-bower/ionicons/css/ionicons.min.css') }}" rel = "stylesheet" type = "text/css" />-->

    <!-- Theme style -->
    <link href="{{ asset('/css/theme.css') }}" rel="stylesheet" type="text/css" media="screen,projection" />
    <!--<link href="{{ asset('/css/materialize.min.css') }}" rel="stylesheet" type="text/css" media="screen,projection" />-->
    <link href="{{ asset('/css/materialize.css') }}" rel="stylesheet" type="text/css" media="screen,projection" />
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css" media="screen,projection" />
    
    <!--<link href="{{ asset('/plugins/materialize/media-hover-effects.css') }}" rel="stylesheet" type="text/css" media="screen,projection" />-->

    <link href="{{ asset('/yezzclub-bower/dropify/dist/css/dropify.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/yezzclub-bower/perfect-scrollbar/min/perfect-scrollbar.min.css') }}" rel = "stylesheet" type = "text/css" />
    <!-- Notifications system -->
    <link href="{{ asset('/yezzclub-bower/pnotify/dist/pnotify.css') }}" rel = "stylesheet" type = "text/css" />
    <link href="{{ asset('/yezzclub-bower/pnotify/dist/pnotify.brighttheme.css') }}" rel = "stylesheet" type="text/css" />
    <link href="{{ asset('/yezzclub-bower/pnotify/dist/pnotify.buttons.css') }}" rel = "stylesheet" type="text/css" />
    <link href="{{ asset('/yezzclub-bower/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/yezzclub-bower/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/app.css') }}" rel = "stylesheet" type = "text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @section('cssCustoms') @show
</head>
