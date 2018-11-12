@extends('layouts.app')

{{-- 
@ section('cssCustoms')
    <link href = "{{ asset('/yezzclub-bower/chartist/dist/chartist.min.css') }}" rel = "stylesheet" type="text/css" />
@ endsection
 --}}

@section('htmlheader_title')
    {{ trans('globals.sections.dashboard') }}
@endsection

@section('contentheader_title')
    {{ trans('globals.sections.dashboard') }}
@endsection

@section('breadcrumb_li')
    <!-- Example <li class="active">Description</li> -->
@endsection

@section('content')

    <div class="section">

        <p class="caption">Simple Page Blank</p>
        <div class="divider"></div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

@endsection
{{-- 
@ section('jsCustoms')
    <script src = "{{ asset('/yezzclub-bower/chartist/dist/chartist.min.js') }}"></script>
@ endsection
 --}}
