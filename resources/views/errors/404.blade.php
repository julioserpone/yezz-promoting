@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="card-panel">
            <div class="row">
                <div class="col s4 offset-s4">
                    <div class="center promo promo-example">
                        <i class="mdi-hardware-phonelink-off"></i>
                        <h1 class="flow-text">{{ trans('errors.404Error') }}</h1>
                        <p class="light center">{{ trans('errors.404ErrorInfo') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection