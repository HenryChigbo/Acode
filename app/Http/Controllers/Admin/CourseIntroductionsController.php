<?php

namespace App\Http\Controllers\Admin;

use App\CourseIntroduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseIntroductionsRequest;
use App\Http\Requests\Admin\UpdateCourseIntroductionsRequest;

class CourseIntroductionsController extends Controller
{
    /**
     * Display a listing of CourseIntroduction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('course_introduction_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('course_introduction_delete')) {
                return abort(401);
            }
            $course_introductions = CourseIntroduction::onlyTrashed()->get();
        } else {
            $course_introductions = CourseIntroduction::all();
        }

        return view('admin.course_introductions.index', compact('course_introductions'));
    }

    /**
     * Show the form for creating new CourseIntroduction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('course_introduction_create')) {
            return abort(401);
        }
        
        $course_keys = \App\Course::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.course_introductions.create', compact('course_keys'));
    }

    /**
     * Store a newly created CourseIntroduction in storage.
     *
     * @param  \App\Http\Requests\StoreCourseIntroductionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseIntroductionsRequest $request)
    {
        if (! Gate::allows('course_introduction_create')) {
            return abort(401);
        }
        $course_introduction = CourseIntroduction::create($request->all());



        return redirect()->route('admin.course_introductions.index');
    }


    /**
     * Show the form for editing CourseIntroduction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('course_introduction_edit')) {
            return abort(401);
        }
        
        $course_keys = \App\Course::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $course_introduction = CourseIntroduction::findOrFail($id);

        return view('admin.course_introductions.edit', compact('course_introduction', 'course_keys'));
    }

    /**
     * Update CourseIntroduction in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseIntroductionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseIntroductionsRequest $request, $id)
    {
        if (! Gate::allows('course_introduction_edit')) {
            return abort(401);
        }
        $course_introduction = CourseIntroduction::findOrFail($id);
        $course_introduction->update($request->all());



        return redirect()->route('admin.course_introductions.index');
    }


    /**
     * Display CourseIntroduction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('course_introduction_view')) {
            return abort(401);
        }
        $course_introduction = CourseIntroduction::findOrFail($id);

        return view('admin.course_introductions.show', compact('course_introduction'));
    }


    /**
     * Remove CourseIntroduction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('course_introduction_delete')) {
            return abort(401);
        }
        $course_introduction = CourseIntroduction::findOrFail($id);
        $course_introduction->delete();

        return redirect()->route('admin.course_introductions.index');
    }

    /**
     * Delete all selected CourseIntroduction at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('course_introduction_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CourseIntroduction::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore CourseIntroduction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('course_introduction_delete')) {
            return abort(401);
        }
        $course_introduction = CourseIntroduction::onlyTrashed()->findOrFail($id);
        $course_introduction->restore();

        return redirect()->route('admin.course_introductions.index');
    }

    /**
     * Permanently delete CourseIntroduction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('course_introduction_delete')) {
            return abort(401);
        }
        $course_introduction = CourseIntroduction::onlyTrashed()->findOrFail($id);
        $course_introduction->forceDelete();

        return redirect()->route('admin.course_introductions.index');
    }
}
