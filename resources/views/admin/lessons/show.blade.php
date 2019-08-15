@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.lesson.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.lesson.fields.name')</th>
                            <td field-key='name'>{{ $lesson->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lesson.fields.description')</th>
                            <td field-key='description'>{{ $lesson->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lesson.fields.content')</th>
                            <td field-key='content'>{{ $lesson->content }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lesson.fields.prerequisite')</th>
                            <td field-key='prerequisite'>{{ $lesson->prerequisite }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lesson.fields.avatar')</th>
                            <td field-key='avatar'>@if($lesson->avatar)<a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $lesson->avatar) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lesson.fields.color-background')</th>
                            <td field-key='color_background'>{{ $lesson->color_background }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lesson.fields.color-foreground')</th>
                            <td field-key='color_foreground'>{{ $lesson->color_foreground }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#user_lesson" aria-controls="user_lesson" role="tab" data-toggle="tab">User lesson</a></li>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.lessons.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


