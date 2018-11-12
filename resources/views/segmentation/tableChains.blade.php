<div class="right">
    <p></p>
    <a  href="{{ url('/store/editChain/') }}" class="btn blue darken-4 waves-effect waves-light">
    <i class="mdi-content-add"></i>&nbsp;{{ trans('segmentation.newChain') }}</a>  
</div>
<table class="bordered">
    <thead>
        <tr>
            <th class="capitalize left-align">{{ trans('segmentation.segments') }}</th>
            <th class="capitalize left-align">{{ trans('segmentation.chains') }}</th>
            <th class="capitalize left-align">{{ trans('segmentation.actions') }}</th>
        </tr>
    </thead>
    <tbody>
      @foreach($chains->sortBy('segment_id')->all() as $row)
        <tr>
          <td>
            <label class="black-text">{{ $segments->first(function ($key, $value) use ($row) {
                return $value->id == $row->segment_id;
              })->translate('es')->name }}</label>
          </td>
          <td>
            <label class="black-text">{{ $row->description }}</label>
          </td>
          <td class="center-align">
              <a  href="{{ url('/store/editChain/'.$row->id) }}" 
                  class="btn-floating waves-effect waves-light light-blue"><i class="mdi-content-create"></i></a>
              <form action="{{ url('/store/removeChain/'.$row->id) }}" method="POST" style="display: inline-block;margin-left: 10px;">
                  {!! csrf_field() !!}
                  <button class="btn-floating waves-effect waves-light" type="submit">
                    <i class="mdi-content-clear"></i>
                  </button>
              </form>
          </td>
        </tr>
      @endforeach
    </tbody>
</table>