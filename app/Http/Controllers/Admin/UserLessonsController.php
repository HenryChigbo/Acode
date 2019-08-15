<?php

namespace App\Http\Controllers\Admin;

use App\UserLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserLessonsRequest;
use App\Http\Requests\Admin\UpdateUserLessonsRequest;

class UserLessonsController extends Controller
{
    /**
     * Display a listing of UserLesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_lesson_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('user_lesson_delete')) {
                return abort(401);
            }
            $user_lessons = UserLesson::onlyTrashed()->get();
        } else {
            $user_lessons = UserLesson::all();
        }

        return view('admin.user_lessons.index', compact('user_lessons'));
    }

    /**
     * Show the form for creating new UserLesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('user_lesson_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');
        $lessons = \App\Lesson::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.user_lessons.create', compact('users', 'lessons'));
    }

    /**
     * Store a newly created UserLesson in storage.
     *
     * @param  \App\Http\Requests\StoreUserLessonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserLessonsRequest $request)
    {
        if (! Gate::allows('user_lesson_create')) {
            return abort(401);
        }
        $user_lesson = UserLesson::create($request->all());



        return redirect()->route('admin.user_lessons.index');
    }


    /**
     * Show the form for editing UserLesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_lesson_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');
        $lessons = \App\Lesson::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $user_lesson = UserLesson::findOrFail($id);

        return view('admin.user_lessons.edit', compact('user_lesson', 'users', 'lessons'));
    }

    /**
     * Update UserLesson in storage.
     *
     * @param  \App\Http\Requests\UpdateUserLessonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserLessonsRequest $request, $id)
    {
        if (! Gate::allows('user_lesson_edit')) {
            return abort(401);
        }
        $user_lesson = UserLesson::findOrFail($id);
        $user_lesson->update($request->all());



        return redirect()->route('admin.user_lessons.index');
    }


    /**
     * Display UserLesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('user_lesson_view')) {
            return abort(401);
        }
        $user_lesson = UserLesson::findOrFail($id);

        return view('admin.user_lessons.show', compact('user_lesson'));
    }


    /**
     * Remove UserLesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('user_lesson_delete')) {
            return abort(401);
        }
        $user_lesson = UserLesson::findOrFail($id);
        $user_lesson->delete();

        return redirect()->route('admin.user_lessons.index');
    }

    /**
     * Delete all selected UserLesson at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('user_lesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = UserLesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore UserLesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('user_lesson_delete')) {
            return abort(401);
        }
        $user_lesson = UserLesson::onlyTrashed()->findOrFail($id);
        $user_lesson->restore();

        return redirect()->route('admin.user_lessons.index');
    }

    /**
     * Permanently delete UserLesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('user_lesson_delete')) {
            return abort(401);
        }
        $user_lesson = UserLesson::onlyTrashed()->findOrFail($id);
        $user_lesson->forceDelete();

        return redirect()->route('admin.user_lessons.index');
    }
}
