@extends('layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.reset_password') }}
@endsection

@section('cssCustoms')
    <style type="text/css" media="screen">
        html,
        body {
            height: 100%;
        }
        html {
            display: table;
            margin: auto;
            
        }
        body {
            display: table-cell;
            vertical-align: middle;
        }
    </style>
@endsection

<!-- Main Content -->
@section('content')
    <form action="{{ url('/password/email') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id="login-page" class="row">
            <div class="col s12 z-depth-4 card-panel">
                <form class="login-form">
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="{{ asset('/img/logo_app_black.png') }}" alt="yezz club" class="responsive-img valign ">
                            <p class="center login-form-text">{{ trans('auth.reset_password') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 input-red">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input id="email" name="email" value="{{ old('email') }}" type="text">
                            <label for="email">{{ trans('auth.email') }}</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="red accent-4 btn waves-effect waves-light col s12">{{ trans('auth.send_password_reset') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
@endsection


@include('layouts.partials.scripts_auth')

@include('layouts.partials.message')
