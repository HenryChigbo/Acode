@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.banners.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.banners.fields.photo-one')</th>
                            <td field-key='photo_one'>@if($banner->photo_one)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_one) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_one) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.banners.fields.photo-two')</th>
                            <td field-key='photo_two'>@if($banner->photo_two)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_two) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_two) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.banners.fields.photo-three')</th>
                            <td field-key='photo_three'>@if($banner->photo_three)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_three) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_three) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.banners.fields.photo-four')</th>
                            <td field-key='photo_four'>@if($banner->photo_four)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_four) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_four) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.banners.fields.photo-five')</th>
                            <td field-key='photo_five'>@if($banner->photo_five)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_five) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_five) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.banners.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


