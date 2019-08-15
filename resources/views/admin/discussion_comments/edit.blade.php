@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.discussion-comment.title')</h3>
    
    {!! Form::model($discussion_comment, ['method' => 'PUT', 'route' => ['admin.discussion_comments.update', $discussion_comment->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comment', trans('global.discussion-comment.fields.comment').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('comment', old('comment'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comment'))
                        <p class="help-block">
                            {{ $errors->first('comment') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('discussion_id', trans('global.discussion-comment.fields.discussion').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('user_id', trans('global.discussion-comment.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

