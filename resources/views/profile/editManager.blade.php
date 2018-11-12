<div id="profile-page-wall-share" class="row">
  <div class="col s12">
    <ul class="tabs tab-profile z-depth-1 blue darken-4" style="width: 100%;">
      <li class="tab col s3">
        <a class="white-text waves-effect waves-light" href="#updateProfile">
          <i class="mdi-editor-border-color"></i> {{ trans('profile.updateProfile') }}
        </a>
      </li>
      <li class="tab col s3">
        <a class="white-text waves-effect waves-light" href="#updatePhoto">
          <i class="mdi-image-camera-alt"></i> {{ trans('profile.updatePicture') }}
        </a>
      </li>
      <li class="tab col s3">
        <a class="white-text waves-effect waves-light" href="#updateContact">
          <i class="mdi-image-photo-album"></i> {{ trans('profile.updateContact') }}
        </a>
      </li>
    </ul>

    <!-- updateProfile-->
    <div id="updateProfile" class="tab-content col s12  grey lighten-4">
        @include('profile.edit')
    </div>

    <!-- updatePhoto -->
    <div id="updatePhoto" class="tab-content col s12  grey lighten-4" style="display: none;">
        @include('profile.editPicture')
    </div>

    <!-- CreateAlbum -->
    <div id="updateContact" class="tab-content col s12  grey lighten-4" style="display: none;">
        @include('profile.editContacts')
    </div>
  </div>
</div>