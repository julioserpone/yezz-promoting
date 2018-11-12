@extends('layouts.auth')

@section('htmlheader_title')
    {{ trans('auth.log_in') }}
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
<!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
  <form action="{{ route('login') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div id="login-page" class="row">
      <div class="col s12 z-depth-4 card-panel">
        <form class="login-form">
          <div class="row">
            <div class="input-field col s12 center">
              <img src="img/logo_app_black.png" alt="yezz club" class="responsive-img valign ">
              <p class="center login-form-text">{{ trans('auth.log_in') }}</p>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="mdi-social-person-outline prefix"></i>
              <input id="username" name="username" value="{{ old('username') }}" type="text">
              <label for="username">{{ trans('auth.username') }}</label>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="mdi-action-lock-outline prefix"></i>
              <input id="password" name="password" type="password">
              <label for="password">{{ trans('auth.password') }}</label>
            </div>
          </div>
          <div class="row">          
            <div class="input-field col s12 m12 l12  login-text fix-pointer">
                <input type="checkbox" class="filled-in" id="remember" name="remember" />
                <label for="remember">{{ trans('auth.remember_me') }}</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button type="submit" class="red accent-4 btn waves-effect waves-light col s12">{{ trans('auth.sign_in') }}</button>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <p class="margin medium-small"><a href="{{ url('/password/reset') }}">{{ trans('auth.forgot_pass') }}?</a></p>
            </div>
            <!-- <div class="input-field col s6 m6 l6">
                <p class="margin right-align medium-small"><a href="page-forgot-password.html">Forgot password ?</a></p>
            </div> -->
          </div>

        </form>
      </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </form>

@endsection

@include('layouts.partials.scripts_auth')

@include('layouts.partials.message')
