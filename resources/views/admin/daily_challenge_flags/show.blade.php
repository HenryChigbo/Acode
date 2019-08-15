@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.daily-challenge-flag.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.daily-challenge-flag.fields.counter')</th>
                            <td field-key='counter'>{{ $daily_challenge_flag->counter }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.daily-challenge-flag.fields.daily-challenge')</th>
                            <td field-key='daily_challenge'>{{ $daily_challenge_flag->daily_challenge->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.daily_challenge_flags.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


