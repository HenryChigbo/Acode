@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.daily-challenge-comment-flag.title')</h3>
    @can('daily_challenge_comment_flag_create')
    <p>
        <a href="{{ route('admin.daily_challenge_comment_flags.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.daily_challenge_comment_flags.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.daily_challenge_comment_flags.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($daily_challenge_comment_flags) > 0 ? 'datatable' : '' }} @can('daily_challenge_comment_flag_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('daily_challenge_comment_flag_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.daily-challenge-comment-flag.fields.counter')</th>
                        <th>@lang('global.daily-challenge-comment-flag.fields.user')</th>
                        <th>@lang('global.daily-challenge-comment-flag.fields.daily-challenge-comment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($daily_challenge_comment_flags) > 0)
                        @foreach ($daily_challenge_comment_flags as $daily_challenge_comment_flag)
                            <tr data-entry-id="{{ $daily_challenge_comment_flag->id }}">
                                @can('daily_challenge_comment_flag_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='counter'>{{ $daily_challenge_comment_flag->counter }}</td>
                                <td field-key='user'>{{ $daily_challenge_comment_flag->user->email ?? '' }}</td>
                                <td field-key='daily_challenge_comment'>{{ $daily_challenge_comment_flag->daily_challenge_comment->comment ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_comment_flags.restore', $daily_challenge_comment_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_comment_flags.perma_del', $daily_challenge_comment_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('daily_challenge_comment_flag_view')
                                    <a href="{{ route('admin.daily_challenge_comment_flags.show',[$daily_challenge_comment_flag->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('daily_challenge_comment_flag_edit')
                                    <a href="{{ route('admin.daily_challenge_comment_flags.edit',[$daily_challenge_comment_flag->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('daily_challenge_comment_flag_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_comment_flags.destroy', $daily_challenge_comment_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('daily_challenge_comment_flag_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.daily_challenge_comment_flags.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection