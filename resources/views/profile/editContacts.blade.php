<div class="row">
  <div class="col s12 m12 l12">
    <div class="card-panel">
      <div class="row">
      <form class="col s12" method="POST" action="{{ url('/user/updateContact') }}" >
        {!! csrf_field() !!}
        {{-- Account Data --}}
        <h4 class="header2">{{ trans('profile.typeOfContact') }}</h4>
        <div class="row">
          <div class="input-field col s10">
              <select id="selectTypeContact">
                <option value=""></option>
                @foreach(trans('profile.arrayContact') as $key =>$value)
                  <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
              </select>
          </div>
          <div id="clone" class="input-field col s2">
            <a  class="btn-floating btn-large waves-effect waves-light light-blue clone-content" 
                remove-class="dummy,invisible" 
                remove-element-attr=".s10 i:class"><i class="mdi-content-add"></i></a>
          </div>
        </div>
        @foreach(trans('profile.arrayContact') as $key => $value)
          <span id="t-contact-{{$key}}" class="invisible">{{$value}}</span>
        @endforeach
        @foreach(trans('profile.arrayContactIcons') as $key => $value)
          <span id="i-contact-{{$key}}" class="invisible"><i class="{{$value}}"></i></span>
        @endforeach
        {{-- End Account Data --}}
        <h4 class="header2" id="testClone" hola que cuentas>{{ trans('profile.contactInfo') }} </h4>
        


        {{-- Dummy --}}
        <div class="row dummy this-content invisible">
          <div class="input-field col s10">
            <i class="mdi-action-account-circle prefix"></i>
            <input type="text" >
            <label></label>
          </div>
          <div class="input-field col s2">
            <a class="btn-floating btn-large waves-effect waves-light remove-content" content="div.this-content"><i class="mdi-content-clear"></i></a>
          </div>
        </div> 

        @if($data->contact->count())
          @foreach($data->contact as $row)
            <div class="row this-content">
              <div class="input-field col s10">
                <i class="{{ trans('profile.arrayContactIcons.'.$row->type) }} prefix"></i>
                <input type="text" name="{{$row->type}}[]" value="{{$row->data}}">
                <label>{{ trans('profile.arrayContact.'.$row->type) }}</label>
              </div>
              <div class="input-field col s2">
                <a class="btn-floating btn-large waves-effect waves-light remove-content" content="div.this-content"><i class="mdi-content-clear"></i></a>
              </div>
            </div>          
          @endforeach
        @endif
        <div class="row">
          <div class="input-field col s12">
            <button class="btn blue waves-effect waves-light right" type="submit">
              {{ trans('profile.send') }}<i class="mdi-content-send right"></i>
            </button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@section("jsCustoms")
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            var icons=
            $('#selectTypeContact').change(function (event) {
              event.preventDefault();
              if($(this).val()){
                $('#clone .clone-content').attr({
                  'clone-content':'div.this-content.dummy',
                  'add-element-attr':'input::name:'+$(this).val()+'[],label::for:'+$(this).val()+'[]',
                  'add-element-class':'.s10 i:prefix,.s10 i:'+$('span#i-contact-'+$(this).val()+' i').attr('class'),
                  'add-element-content':$('span#t-contact-'+$(this).val()).text(),
                  'elements':'label'
                });

              }else{
                $('#clone .clone-content').removeAttr('clone-content');
              }
            });
        });
    </script>
@endsection