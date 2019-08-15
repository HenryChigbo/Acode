@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.banners.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.banners.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('photo_one', trans('global.banners.fields.photo-one').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_one', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_one_max_size', 2) !!}
                    {!! Form::hidden('photo_one_max_width', 1000) !!}
                    {!! Form::hidden('photo_one_max_height', 1000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_one'))
                        <p class="help-block">
                            {{ $errors->first('photo_one') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('photo_two', trans('global.banners.fields.photo-two').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_two', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_two_max_size', 2) !!}
                    {!! Form::hidden('photo_two_max_width', 1000) !!}
                    {!! Form::hidden('photo_two_max_height', 1000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_two'))
                        <p class="help-block">
                            {{ $errors->first('photo_two') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('photo_three', trans('global.banners.fields.photo-three').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_three', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_three_max_size', 2) !!}
                    {!! Form::hidden('photo_three_max_width', 1000) !!}
                    {!! Form::hidden('photo_three_max_height', 1000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_three'))
                        <p class="help-block">
                            {{ $errors->first('photo_three') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('photo_four', trans('global.banners.fields.photo-four').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_four', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_four_max_size', 2) !!}
                    {!! Form::hidden('photo_four_max_width', 1000) !!}
                    {!! Form::hidden('photo_four_max_height', 1000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_four'))
                        <p class="help-block">
                            {{ $errors->first('photo_four') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('photo_five', trans('global.banners.fields.photo-five').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo_five', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_five_max_size', 2) !!}
                    {!! Form::hidden('photo_five_max_width', 1000) !!}
                    {!! Form::hidden('photo_five_max_height', 1000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo_five'))
                        <p class="help-block">
                            {{ $errors->first('photo_five') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

