<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="user-details blue darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="{{ getenv('S3_FOLDER_BASE')}}{{ isset($user)?$user->person->pic_url:\Auth::user()->person->pic_url }}" alt="" class="circle responsive-img valign profile-image">
                </div>
                <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="{{ route('profile') }}"><i class="mdi-action-face-unlock"></i>{{ trans('menu_left.profile') }}</a>
                        <li><a href="{{ url('/logout') }}"><i class="mdi-hardware-keyboard-tab"></i>{{ trans('menu_left.logout') }}</a>
                        </li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">{{ isset($user)?$user->full_name:\Auth::user()->full_name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal">{{ isset($user)?$user->profile->name:\Auth::user()->profile->name }}</p>
                </div>
            </div>
        </li>
        <li class="bold"><a href="{{ route('download-apk') }}" class="waves-effect waves-cyan"><i class="mdi-file-cloud-download"></i>{{ trans('menu_left.download_apk') }}</a>
        <li class="bold"><a href="{{ url('/') }}" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>{{ trans('menu_left.dashboard') }}</a></li>
        <li class="bold"><a href="{{ url('/user/profile') }}" class="waves-effect waves-cyan"><i class="mdi-action-account-circle"></i>{{ trans('menu_left.profile') }}</a></li>
        @if (in_array(\Auth::user()->profile->code,['seller','administrator','trademarketing','leader_agency','leader_pdv']))
        <li class="bold"><a href="{{ url('/products/') }}" class="waves-effect waves-cyan"><i class="mdi-hardware-phone-android"></i>{{ trans('menu_left.products') }}</a></li>
        @endif

        @if (in_array(\Auth::user()->profile->code,['promotor','seller','administrator','trademarketing','leader_agency','leader_pdv']))
        <li class="bold"><a href="{{ url('/store/store') }}" class="waves-effect waves-cyan"><i class="mdi-maps-store-mall-directory"></i>{{ trans('menu_left.store') }}</a></li>
        <li class="bold"><a href="{{ url('/activities') }}" class="waves-effect waves-cyan"><i class="mdi-action-view-list"></i>{{ trans('menu_left.activities') }}</a>
        @endif

        <!-- only for administrator -->
        @if (in_array(\Auth::user()->profile->code,['administrator','trademarketing']))
        <li class="bold"><a href="{{ url('/store/map/') }}" class="waves-effect waves-cyan"><i class="mdi-action-room"></i>{{ trans('menu_left.localization') }}</a>
        @endif

        @if (in_array(\Auth::user()->profile->code,['administrator']))    
        <!-- Routes for system administration -->
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-settings"></i>{{ trans('menu_left.system') }}</a>
                    <div class="collapsible-body" style="">
                        <ul>
                            <li><a href="{{ url('/store/category') }}"><i class="mdi-action-dns"></i>{{ trans('menu_left.categories') }}</a></li>
                            <li><a href="{{ url('/product/devices') }}"><i class="mdi-device-devices "></i>{{ trans('menu_left.devices') }}</a></li>
                            <li><a href="{{ url('/user/sectors') }}"><i class="mdi-action-track-changes"></i>{{ trans('menu_left.user_sectors') }}</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        @endif
    </ul>
    <!--<a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only blue"><i class="mdi-navigation-menu"></i></a>-->
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only blue button-collapse"><i class="mdi-navigation-menu"></i></a>
</aside>