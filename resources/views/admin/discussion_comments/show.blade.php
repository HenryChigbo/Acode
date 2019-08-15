@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.discussion-comment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.discussion-comment.fields.comment')</th>
                            <td field-key='comment'>{{ $discussion_comment->comment }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion-comment.fields.discussion')</th>
                            <td field-key='discussion'>{{ $discussion_comment->discussion->question ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.discussion-comment.fields.user')</th>
                            <td field-key='user'>{{ $discussion_comment->user->email ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.discussion_comments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


