@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.courses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.courses.fields.name')</th>
                            <td field-key='name'>{{ $course->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.image')</th>
                            <td field-key='image'>@if($course->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.key')</th>
                            <td field-key='key'>{{ $course->key }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#course_introduction" aria-controls="course_introduction" role="tab" data-toggle="tab">Course introduction</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="course_introduction">
<table class="table table-bordered table-striped {{ count($course_introductions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.course-introduction.fields.title')</th>
                        <th>@lang('global.course-introduction.fields.description')</th>
                        <th>@lang('global.course-introduction.fields.course-key')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($course_introductions) > 0)
            @foreach ($course_introductions as $course_introduction)
                <tr data-entry-id="{{ $course_introduction->id }}">
                    <td field-key='title'>{{ $course_introduction->title }}</td>
                                <td field-key='description'>{{ $course_introduction->description }}</td>
                                <td field-key='course_key'>{{ $course_introduction->course_key->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.course_introductions.restore', $course_introduction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.course_introductions.perma_del', $course_introduction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('course_introduction_view')
                                    <a href="{{ route('admin.course_introductions.show',[$course_introduction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('course_introduction_edit')
                                    <a href="{{ route('admin.course_introductions.edit',[$course_introduction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('course_introduction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.course_introductions.destroy', $course_introduction->id])) !!}
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

            <a href="{{ route('admin.courses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


