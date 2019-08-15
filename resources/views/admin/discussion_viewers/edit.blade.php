@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.discussion-viewer.title')</h3>
    
    {!! Form::model($discussion_viewer, ['method' => 'PUT', 'route' => ['admin.discussion_viewers.update', $discussion_viewer->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('discussion_id', trans('global.discussion-viewer.fields.discussion').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('discussion_id', $discussions, old('discussion_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('discussion_id'))
                        <p class="help-block">
                            {{ $errors->first('discussion_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('counter', trans('global.discussion-viewer.fields.counter').'', ['class' => 'control-label']) !!}
                    {!! Form::number('counter', old('counter'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('counter'))
                        <p class="help-block">
                            {{ $errors->first('counter') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

