@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.lesson.title')</h3>
    
    {!! Form::model($lesson, ['method' => 'PUT', 'route' => ['admin.lessons.update', $lesson->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.lesson.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.lesson.fields.description').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('content', trans('global.lesson.fields.content').'', ['class' => 'control-label']) !!}
                    {!! Form::text('content', old('content'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('prerequisite', trans('global.lesson.fields.prerequisite').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prerequisite', old('prerequisite'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('prerequisite'))
                        <p class="help-block">
                            {{ $errors->first('prerequisite') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($lesson->avatar)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$lesson->avatar) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$lesson->avatar) }}"></a>
                    @endif
                    {!! Form::label('avatar', trans('global.lesson.fields.avatar').'', ['class' => 'control-label']) !!}
                    {!! Form::file('avatar', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('avatar_max_size', 2) !!}
                    {!! Form::hidden('avatar_max_width', 600) !!}
                    {!! Form::hidden('avatar_max_height', 600) !!}
                    <p class="help-block"></p>
                    @if($errors->has('avatar'))
                        <p class="help-block">
                            {{ $errors->first('avatar') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('color_background', trans('global.lesson.fields.color-background').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('color_background', old('color_background'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('color_background'))
                        <p class="help-block">
                            {{ $errors->first('color_background') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('color_foreground', trans('global.lesson.fields.color-foreground').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('color_foreground', old('color_foreground'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('color_foreground'))
                        <p class="help-block">
                            {{ $errors->first('color_foreground') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

