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

@section('content')

    <form action="{{ url('/password/reset') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <div id="login-page" class="row">
            <div class="col s12 z-depth-4 card-panel">
                <form class="login-form">
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="{{ asset('/img/logo_app_black.png') }}" alt="yezz club" class="responsive-img valign ">
                            <p class="center login-form-text">{{ trans('auth.reset_password') }}</p>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-social-person-outline prefix"></i>
                            <input id="email" name="email" value="{{ $email or old('email') }}" type="text">
                            <label for="email">{{ trans('auth.email') }}</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="password" name="password" type="password">
                            <label for="password">{{ trans('auth.password') }}</label>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="mdi-action-lock-outline prefix"></i>
                            <input id="password-confirm" name="password_confirmation" type="password">
                            <label for="password-confirm">{{ trans('auth.confirm_password') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="red accent-4 btn waves-effect waves-light col s12">
                                <i class="fa fa-btn fa-refresh"></i>&nbsp;{{ trans('auth.reset_password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>

@endsection

@include('layouts.partials.scripts_auth')

@include('layouts.partials.message')