@extends('layouts.app')

@section('content')
<div id="profile-page" class="section">
    {{-- Header Profile --}}
    <div id="profile-page-header" class="card">
        <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="{{ asset('img/bg-card.jpg') }}" alt="user background">
        </div>
        <figure class="card-profile-image">
            <img src="{{ getenv('S3_FOLDER_BASE')}}{{ $data->person->pic_url }}" alt="profile image" class="circle z-depth-2 responsive-img activator">
        </figure>
        <div class="card-content">
          <div class="row">                    
            <div class="col s3 offset-s2">                        
                <h4 class="card-title grey-text text-darken-4">{{ $data->full_name }}</h4>
                <p class="medium-small grey-text">{{ $data->profile->name }}</p>                        
            </div>
            <div class="col s1 offset-s6 right-align">
              <a class="btn-floating activator waves-effect waves-light darken-2 right">
                  <i class="mdi-action-perm-identity"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="card-reveal" style="display: none; transform: translateY(0px);">
            <p>
              <span class="card-title grey-text text-darken-4">{{ $data->full_name }}<i class="mdi-navigation-close right"></i></span>
              <span><i class="mdi-action-perm-identity cyan-text text-darken-2"></i>{{ $data->profile->name }}</span>
            </p>
            <p>{{ $data->person->description }}</p>
            @foreach($data->contact as $row)
                <p>
                    <i class="{{ trans('profile.arrayContactIcons.'.$row->type) }} cyan-text text-darken-2"></i> 
                    <strong> {{ trans('profile.arrayContact.'.$row->type) }}:</strong> {{ $row->data }}
                </p>
            @endforeach
            <p><i class="mdi-communication-email cyan-text text-darken-2"></i><strong> {{ trans('profile.email') }}: </strong>{{ $data->email }}</p>
            <p><i class="mdi-social-cake cyan-text text-darken-2"></i><strong> {{ trans('profile.birthdate') }} </strong>{{ $data->person->b_date }}</p>
        </div>
    </div>
    {{-- End Header Profile --}}
    
    <div id="profile-page-content" class="row">
        {{-- Left Profile --}}
        <div id="profile-page-sidebar" class="col s12 m4">
            {{-- About Me --}}
            @if ($data->person->description)
            <div class="card blue darken-4">
                <div class="card-content white-text">
                    <span class="card-title">{{ trans('profile.aboutMe') }}</span>
                    <p>{{ $data->person->description }}</p>
                </div>                  
            </div>
            @endif
            {{-- End About Me --}}

            {{-- Profile Details --}}
            <ul id="profile-page-about-details" class="collection z-depth-1">
                <li class="collection-item">
                    <div class="row">
                    <div class="col s5 grey-text darken-1">
                        <i class="mdi-action-wallet-travel"></i>&nbsp;{{ trans('profile.profile') }}</div>
                    <div class="col s7 grey-text text-darken-4 right-align">{{ $data->profile->name }}</div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                    <div class="col s5 grey-text darken-1"><i class="mdi-social-domain"></i>&nbsp;{{ trans('profile.livesIn') }}</div>
                    <div class="col s7 grey-text text-darken-4 right-align">{{ $data->person->country->name }}</div>
                    </div>
                </li>
                <li class="collection-item">
                    <div class="row">
                    <div class="col s5 grey-text darken-1"><i class="mdi-social-cake"></i>&nbsp;{{ trans('profile.birthdate') }}</div>
                    <div class="col s7 grey-text text-darken-4 right-align">{{ $data->person->b_date }}</div>
                    </div>
                </li>
            </ul>
            {{-- End Profile Details --}}
        </div>
        {{-- End Left Profile --}}
        <div id="profile-page-wall" class="col s12 m8">
            @if(isset($user) && $user->id==$data->id)
                @include('profile.editManager')
            @endif
        </div>
    </div>
  </div>
@endsection