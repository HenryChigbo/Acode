@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.daily-challenge.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.daily-challenge.fields.name')</th>
                            <td field-key='name'>{{ $daily_challenge->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.daily-challenge.fields.description')</th>
                            <td field-key='description'>{{ $daily_challenge->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.daily-challenge.fields.image')</th>
                            <td field-key='image'>@if($daily_challenge->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $daily_challenge->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $daily_challenge->image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#daily_challenge_flag" aria-controls="daily_challenge_flag" role="tab" data-toggle="tab">Daily challenge flag</a></li>
<li role="presentation" class=""><a href="#daily_challenge_comment" aria-controls="daily_challenge_comment" role="tab" data-toggle="tab">Daily challenge comment</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="daily_challenge_flag">
<table class="table table-bordered table-striped {{ count($daily_challenge_flags) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.daily-challenge-flag.fields.counter')</th>
                        <th>@lang('global.daily-challenge-flag.fields.daily-challenge')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($daily_challenge_flags) > 0)
            @foreach ($daily_challenge_flags as $daily_challenge_flag)
                <tr data-entry-id="{{ $daily_challenge_flag->id }}">
                    <td field-key='counter'>{{ $daily_challenge_flag->counter }}</td>
                                <td field-key='daily_challenge'>{{ $daily_challenge_flag->daily_challenge->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_flags.restore', $daily_challenge_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_flags.perma_del', $daily_challenge_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('daily_challenge_flag_view')
                                    <a href="{{ route('admin.daily_challenge_flags.show',[$daily_challenge_flag->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('daily_challenge_flag_edit')
                                    <a href="{{ route('admin.daily_challenge_flags.edit',[$daily_challenge_flag->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('daily_challenge_flag_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_flags.destroy', $daily_challenge_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="daily_challenge_comment">
<table class="table table-bordered table-striped {{ count($daily_challenge_comments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.daily-challenge-comment.fields.comment')</th>
                        <th>@lang('global.daily-challenge-comment.fields.daily-challenge')</th>
                        <th>@lang('global.daily-challenge-comment.fields.user')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($daily_challenge_comments) > 0)
            @foreach ($daily_challenge_comments as $daily_challenge_comment)
                <tr data-entry-id="{{ $daily_challenge_comment->id }}">
                    <td field-key='comment'>{{ $daily_challenge_comment->comment }}</td>
                                <td field-key='daily_challenge'>{{ $daily_challenge_comment->daily_challenge->name ?? '' }}</td>
                                <td field-key='user'>{{ $daily_challenge_comment->user->email ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_comments.restore', $daily_challenge_comment->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_comments.perma_del', $daily_challenge_comment->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('daily_challenge_comment_view')
                                    <a href="{{ route('admin.daily_challenge_comments.show',[$daily_challenge_comment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('daily_challenge_comment_edit')
                                    <a href="{{ route('admin.daily_challenge_comments.edit',[$daily_challenge_comment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('daily_challenge_comment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.daily_challenge_comments.destroy', $daily_challenge_comment->id])) !!}
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.daily_challenges.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


