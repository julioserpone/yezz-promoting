<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <div class="row">
      <form class="col s12" method="POST" action="{{ url('/user/updateProfilePicture') }}" enctype= "multipart/form-data" >
        {!! csrf_field() !!}
        {{-- Account Data --}}
        <h4 class="header2">{{ trans('profile.uploadPicture') }}</h4>
        <div class="row">
          <div class="input-field col s12">
              <input type="file" name="file" class="dropify" data-default-file="" data-max-file-size="3M" data-allowed-file-extensions="png icon jpg jpge gif"/>
              @include('errors.formElement',['label'=>'file'])
            </div>
        </div>
        {{-- End Account Data --}}

        <div class="row">
          <div class="input-field col s12">
            <button class="btn blue waves-effect waves-light right" type="submit">{{ trans('profile.send') }}
              <i class="mdi-content-send right"></i>
            </button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>