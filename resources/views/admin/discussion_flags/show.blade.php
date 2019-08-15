@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.discussion-flag.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.discussion-flag.fields.discussion')</th>
                            <td field-key='discussion'>{{ $discussion_flag->discussion->question ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion-flag.fields.user')</th>
                            <td field-key='user'>{{ $discussion_flag->user->email ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion-flag.fields.counter')</th>
                            <td field-key='counter'>{{ $discussion_flag->counter }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.discussion_flags.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


