@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.discussion-viewer.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.discussion-viewer.fields.discussion')</th>
                            <td field-key='discussion'>{{ $discussion_viewer->discussion->question ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion-viewer.fields.counter')</th>
                            <td field-key='counter'>{{ $discussion_viewer->counter }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.discussion_viewers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


