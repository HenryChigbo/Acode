@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.course-introduction.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.course-introduction.fields.title')</th>
                            <td field-key='title'>{{ $course_introduction->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.course-introduction.fields.description')</th>
                            <td field-key='description'>{{ $course_introduction->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.course-introduction.fields.course-key')</th>
                            <td field-key='course_key'>{{ $course_introduction->course_key->name ?? '' }}</td>
<td field-key='key'>{{ isset($course_introduction->course_key) ? $course_introduction->course_key->key : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.course_introductions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


