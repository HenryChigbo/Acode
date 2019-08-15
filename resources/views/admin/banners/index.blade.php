@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.banners.title')</h3>
    @can('banner_create')
    <p>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.banners.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.banners.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($banners) > 0 ? 'datatable' : '' }} @can('banner_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('banner_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.banners.fields.photo-one')</th>
                        <th>@lang('global.banners.fields.photo-two')</th>
                        <th>@lang('global.banners.fields.photo-three')</th>
                        <th>@lang('global.banners.fields.photo-four')</th>
                        <th>@lang('global.banners.fields.photo-five')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($banners) > 0)
                        @foreach ($banners as $banner)
                            <tr data-entry-id="{{ $banner->id }}">
                                @can('banner_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='photo_one'>@if($banner->photo_one)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_one) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_one) }}"/></a>@endif</td>
                                <td field-key='photo_two'>@if($banner->photo_two)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_two) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_two) }}"/></a>@endif</td>
                                <td field-key='photo_three'>@if($banner->photo_three)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_three) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_three) }}"/></a>@endif</td>
                                <td field-key='photo_four'>@if($banner->photo_four)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_four) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_four) }}"/></a>@endif</td>
                                <td field-key='photo_five'>@if($banner->photo_five)<a href="{{ asset(env('UPLOAD_PATH').'/' . $banner->photo_five) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $banner->photo_five) }}"/></a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.banners.restore', $banner->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.banners.perma_del', $banner->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('banner_view')
                                    <a href="{{ route('admin.banners.show',[$banner->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('banner_edit')
                                    <a href="{{ route('admin.banners.edit',[$banner->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('banner_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.banners.destroy', $banner->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('banner_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.banners.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection