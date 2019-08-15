@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.daily-challenge-comment.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.daily_challenge_comments.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comment', trans('global.daily-challenge-comment.fields.comment').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('daily_challenge_id', trans('global.daily-challenge-comment.fields.daily-challenge').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('daily_challenge_id', $daily_challenges, old('daily_challenge_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('daily_challenge_id'))
                        <p class="help-block">
                            {{ $errors->first('daily_challenge_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.daily-challenge-comment.fields.user').'*', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

