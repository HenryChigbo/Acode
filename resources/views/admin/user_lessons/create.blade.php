@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.user-lesson.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.user_lessons.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('users_id', trans('global.user-lesson.fields.users').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('users_id', $users, old('users_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('users_id'))
                        <p class="help-block">
                            {{ $errors->first('users_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lesson_id', trans('global.user-lesson.fields.lesson').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('lesson_id', $lessons, old('lesson_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('lesson_id'))
                        <p class="help-block">
                            {{ $errors->first('lesson_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

