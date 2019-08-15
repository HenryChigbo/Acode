@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.daily-challenge-flag.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.daily_challenge_flags.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('counter', trans('global.daily-challenge-flag.fields.counter').'', ['class' => 'control-label']) !!}
                    {!! Form::number('counter', old('counter'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('counter'))
                        <p class="help-block">
                            {{ $errors->first('counter') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('daily_challenge_id', trans('global.daily-challenge-flag.fields.daily-challenge').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('daily_challenge_id', $daily_challenges, old('daily_challenge_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('daily_challenge_id'))
                        <p class="help-block">
                            {{ $errors->first('daily_challenge_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

