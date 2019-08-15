@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.avatar')</th>
                            <td field-key='avatar'>@if($user->avatar)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->avatar) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.country')</th>
                            <td field-key='country'>{{ $user->country }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#user_lesson" aria-controls="user_lesson" role="tab" data-toggle="tab">User lesson</a></li>
<li role="presentation" class=""><a href="#daily_challenge_comment_flag" aria-controls="daily_challenge_comment_flag" role="tab" data-toggle="tab">Daily challenge comment flag</a></li>
<li role="presentation" class=""><a href="#discussion_flag" aria-controls="discussion_flag" role="tab" data-toggle="tab">Discussion flag</a></li>
<li role="presentation" class=""><a href="#daily_challenge_comment" aria-controls="daily_challenge_comment" role="tab" data-toggle="tab">Daily challenge comment</a></li>
<li role="presentation" class=""><a href="#discussion_comment" aria-controls="discussion_comment" role="tab" data-toggle="tab">Discussion comment</a></li>
<li role="presentation" class=""><a href="#discussion" aria-controls="discussion" role="tab" data-toggle="tab">Discussion</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="user_lesson">
<table class="table table-bordered table-striped {{ count($user_lessons) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.user-lesson.fields.users')</th>
                        <th>@lang('global.user-lesson.fields.lesson')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($user_lessons) > 0)
            @foreach ($user_lessons as $user_lesson)
                <tr data-entry-id="{{ $user_lesson->id }}">
                    <td field-key='users'>{{ $user_lesson->users->email ?? '' }}</td>
                                <td field-key='lesson'>{{ $user_lesson->lesson->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.user_lessons.restore', $user_lesson->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.user_lessons.perma_del', $user_lesson->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('user_lesson_view')
                                    <a href="{{ route('admin.user_lessons.show',[$user_lesson->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('user_lesson_edit')
                                    <a href="{{ route('admin.user_lessons.edit',[$user_lesson->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('user_lesson_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.user_lessons.destroy', $user_lesson->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="daily_challenge_comment_flag">
<table class="table table-bordered table-striped {{ count($daily_challenge_comment_flags) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
<div role="tabpanel" class="tab-pane " id="discussion_flag">
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
<div role="tabpanel" class="tab-pane " id="discussion">
<table class="table table-bordered table-striped {{ count($discussions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.discussion.fields.question')</th>
                        <th>@lang('global.discussion.fields.tags')</th>
                        <th>@lang('global.discussion.fields.description')</th>
                        <th>@lang('global.discussion.fields.post')</th>
                        <th>@lang('global.discussion.fields.user')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($discussions) > 0)
            @foreach ($discussions as $discussion)
                <tr data-entry-id="{{ $discussion->id }}">
                    <td field-key='question'>{{ $discussion->question }}</td>
                                <td field-key='tags'>{{ $discussion->tags }}</td>
                                <td field-key='description'>{{ $discussion->description }}</td>
                                <td field-key='post'>{{ $discussion->post }}</td>
                                <td field-key='user'>{{ $discussion->user->email ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussions.restore', $discussion->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussions.perma_del', $discussion->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('discussion_view')
                                    <a href="{{ route('admin.discussions.show',[$discussion->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('discussion_edit')
                                    <a href="{{ route('admin.discussions.edit',[$discussion->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('discussion_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.discussions.destroy', $discussion->id])) !!}
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


