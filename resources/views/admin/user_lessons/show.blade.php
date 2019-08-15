@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.user-lesson.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.user-lesson.fields.users')</th>
                            <td field-key='users'>{{ $user_lesson->users->email ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.user-lesson.fields.lesson')</th>
                            <td field-key='lesson'>{{ $user_lesson->lesson->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.user_lessons.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


