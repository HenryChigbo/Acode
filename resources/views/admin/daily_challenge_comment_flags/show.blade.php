@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.daily-challenge-comment-flag.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.daily-challenge-comment-flag.fields.counter')</th>
                            <td field-key='counter'>{{ $daily_challenge_comment_flag->counter }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.daily-challenge-comment-flag.fields.user')</th>
                            <td field-key='user'>{{ $daily_challenge_comment_flag->user->email ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.daily-challenge-comment-flag.fields.daily-challenge-comment')</th>
                            <td field-key='daily_challenge_comment'>{{ $daily_challenge_comment_flag->daily_challenge_comment->comment ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.daily_challenge_comment_flags.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


