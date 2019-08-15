@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.discussion.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.discussion.fields.question')</th>
                            <td field-key='question'>{{ $discussion->question }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion.fields.tags')</th>
                            <td field-key='tags'>{{ $discussion->tags }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion.fields.description')</th>
                            <td field-key='description'>{{ $discussion->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion.fields.post')</th>
                            <td field-key='post'>{{ $discussion->post }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion.fields.user')</th>
                            <td field-key='user'>{{ $discussion->user->email ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#discussion_flag" aria-controls="discussion_flag" role="tab" data-toggle="tab">Discussion flag</a></li>
<li role="presentation" class=""><a href="#discussion_viewer" aria-controls="discussion_viewer" role="tab" data-toggle="tab">Discussion viewer</a></li>
<li role="presentation" class=""><a href="#discussion_comment" aria-controls="discussion_comment" role="tab" data-toggle="tab">Discussion comment</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="discussion_flag">
<table class="table table-bordered table-striped {{ count($discussion_flags) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.discussion-flag.fields.discussion')</th>
                        <th>@lang('global.discussion-flag.fields.user')</th>
                        <th>@lang('global.discussion-flag.fields.counter')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($discussion_flags) > 0)
            @foreach ($discussion_flags as $discussion_flag)
                <tr data-entry-id="{{ $discussion_flag->id }}">
                    <td field-key='discussion'>{{ $discussion_flag->discussion->question ?? '' }}</td>
                                <td field-key='user'>{{ $discussion_flag->user->email ?? '' }}</td>
                                <td field-key='counter'>{{ $discussion_flag->counter }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_flags.restore', $discussion_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_flags.perma_del', $discussion_flag->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('discussion_flag_view')
                                    <a href="{{ route('admin.discussion_flags.show',[$discussion_flag->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('discussion_flag_edit')
                                    <a href="{{ route('admin.discussion_flags.edit',[$discussion_flag->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('discussion_flag_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_flags.destroy', $discussion_flag->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="discussion_viewer">
<table class="table table-bordered table-striped {{ count($discussion_viewers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.discussion-viewer.fields.discussion')</th>
                        <th>@lang('global.discussion-viewer.fields.counter')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($discussion_viewers) > 0)
            @foreach ($discussion_viewers as $discussion_viewer)
                <tr data-entry-id="{{ $discussion_viewer->id }}">
                    <td field-key='discussion'>{{ $discussion_viewer->discussion->question ?? '' }}</td>
                                <td field-key='counter'>{{ $discussion_viewer->counter }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_viewers.restore', $discussion_viewer->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_viewers.perma_del', $discussion_viewer->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('discussion_viewer_view')
                                    <a href="{{ route('admin.discussion_viewers.show',[$discussion_viewer->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('discussion_viewer_edit')
                                    <a href="{{ route('admin.discussion_viewers.edit',[$discussion_viewer->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('discussion_viewer_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_viewers.destroy', $discussion_viewer->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="discussion_comment">
<table class="table table-bordered table-striped {{ count($discussion_comments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.discussion-comment.fields.comment')</th>
                        <th>@lang('global.discussion-comment.fields.discussion')</th>
                        <th>@lang('global.discussion-comment.fields.user')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($discussion_comments) > 0)
            @foreach ($discussion_comments as $discussion_comment)
                <tr data-entry-id="{{ $discussion_comment->id }}">
                    <td field-key='comment'>{{ $discussion_comment->comment }}</td>
                                <td field-key='discussion'>{{ $discussion_comment->discussion->question ?? '' }}</td>
                                <td field-key='user'>{{ $discussion_comment->user->email ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_comments.restore', $discussion_comment->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_comments.perma_del', $discussion_comment->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('discussion_comment_view')
                                    <a href="{{ route('admin.discussion_comments.show',[$discussion_comment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('discussion_comment_edit')
                                    <a href="{{ route('admin.discussion_comments.edit',[$discussion_comment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('discussion_comment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussion_comments.destroy', $discussion_comment->id])) !!}
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

            <a href="{{ route('admin.discussions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


