<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <div class="row">
      <form class="col s12" method="POST" action="{{ url('/user/updateProfile') }}" >
        {!! csrf_field() !!}
        {{-- Account Data --}}
        <h4 class="header2">{{ trans('profile.account') }}</h4>
        <div class="row">
          <div class="row">
            <div class="input-field col s6">
              <input type="text" name="username" value="{{ \defValue::text(old(),$data,'username') }}">
              <label for="username" class="">{{ trans('profile.username') }}</label>
              @include('errors.formElement',['label'=>'username'])
            </div>
            <div class="input-field col s6">
              <input type="email" name="email" value="{{ \defValue::text(old(),$data,'email') }}">
              <label for="email" class="">{{ trans('profile.email') }}</label>
              @include('errors.formElement',['label'=>'email'])
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
                <select name="country">
                  <option value=""></option>
                  @foreach($countries as $key =>$value)
                  <option value="{{ $key }}" {!! \defValue::select(old(),$data,'country_id',$key) !!}>{{ $value }}</option>
                  @endforeach
                </select>
                <label>{{ trans('profile.country') }}</label>
                @include('errors.formElement',['label'=>'country'])
            </div>
          </div>
        </div>
        {{-- End Account Data --}}
        <h4 class="header2">{{ trans('profile.personalInfo') }}</h4>
        
        {{-- First Name And Last Name --}}
        <div class="row">
          <div class="input-field col s6">
            <input  type="text" name="firstName" 
                    value="{{ \defValue::text(old(),$data->person,['firstName','first_name']) }}">
            <label for="firstName" class="">{{ trans('profile.firstName') }}</label>
            @include('errors.formElement',['label'=>'firstName'])
          </div>
          <div class="input-field col s6">
            <input  type="text" name="lastName" 
                    value="{{ \defValue::text(old(),$data->person,['lastName','last_name']) }}">
            <label for="lastName" class="">{{ trans('profile.lastName') }}</label>
            @include('errors.formElement',['label'=>'lastName'])
          </div>
        </div>
        
        {{-- person Country And Code --}}
        <div class="row">
          <div class="input-field col s6">
            <select name="personCountry">
              <option value=""></option>
              @foreach($countries as $key =>$value)
                <option value="{{ $key }}" {!! \defValue::select(old(),$data->person,['personCountry','country_id'],$key) !!}> {{ $value }}</option>
              @endforeach
            </select>
            <label>{{ trans('profile.livesIn') }}</label>
            @include('errors.formElement',['label'=>'personCountry'])
          </div>
          <div class="input-field col s6">
            <input  type="text" name="code" 
                    value="{{ \defValue::text(old(),$data->person,['code','identity_code']) }}">
            <label for="code" class="">{{ trans('profile.identification') }}</label>
            @include('errors.formElement',['label'=>'code'])
          </div>
        </div>
        
        {{-- Address --}}
        <div class="row">
          <div class="input-field col s12">
              <textarea name="address" class="materialize-textarea">{{ \defValue::text(old(),$data->person,'address') }}</textarea>
              <label for="textarea1">{{ trans('profile.address') }}</label>
          </div>
        </div>

        {{-- Birthdate And Gender --}}
        <div class="row">
          <div class="input-field col s6">
            <input  type="date" name="birthdate" class="datepicker" value="{{ \defValue::text(old(),$data->person,'birthdate') }}">
            <label for="birthdate" class="">{{ trans('profile.birthdate') }}</label>
            @include('errors.formElement',['label'=>'birthdate'])
          </div>
          <div class="input-field col s6">
            <select name="gender">
              <option value=""></option>
              @foreach(trans('profile.arrayGender') as $key =>$value)
                <option value="{{ $key }}" {!! \defValue::select(old(),$data->person,'gender',$key) !!}>{{ $value }}</option>
              @endforeach
            </select>
            @include('errors.formElement',['label'=>'gender'])
            <label>{{ trans('profile.gender') }}</label>
          </div>
        </div>

        {{-- description --}}
        <div class="row">
          <div class="input-field col s12">
              <textarea name="description" class="materialize-textarea">{{ \defValue::text(old(),$data->person,'description') }}</textarea>
              <label for="textarea1">{{ trans('profile.description') }}</label>
          </div>
        </div>

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