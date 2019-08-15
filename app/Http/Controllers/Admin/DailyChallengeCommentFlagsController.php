<?php

namespace App\Http\Controllers\Admin;

use App\DailyChallengeCommentFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengeCommentFlagsRequest;
use App\Http\Requests\Admin\UpdateDailyChallengeCommentFlagsRequest;

class DailyChallengeCommentFlagsController extends Controller
{
    /**
     * Display a listing of DailyChallengeCommentFlag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('daily_challenge_comment_flag_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('daily_challenge_comment_flag_delete')) {
                return abort(401);
            }
            $daily_challenge_comment_flags = DailyChallengeCommentFlag::onlyTrashed()->get();
        } else {
            $daily_challenge_comment_flags = DailyChallengeCommentFlag::all();
        }

        return view('admin.daily_challenge_comment_flags.index', compact('daily_challenge_comment_flags'));
    }

    /**
     * Show the form for creating new DailyChallengeCommentFlag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('daily_challenge_comment_flag_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');
        $daily_challenge_comments = \App\DailyChallengeComment::get()->pluck('comment', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.daily_challenge_comment_flags.create', compact('users', 'daily_challenge_comments'));
    }

    /**
     * Store a newly created DailyChallengeCommentFlag in storage.
     *
     * @param  \App\Http\Requests\StoreDailyChallengeCommentFlagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDailyChallengeCommentFlagsRequest $request)
    {
        if (! Gate::allows('daily_challenge_comment_flag_create')) {
            return abort(401);
        }
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::create($request->all());



        return redirect()->route('admin.daily_challenge_comment_flags.index');
    }


    /**
     * Show the form for editing DailyChallengeCommentFlag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('daily_challenge_comment_flag_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');
        $daily_challenge_comments = \App\DailyChallengeComment::get()->pluck('comment', 'id')->prepend(trans('global.app_please_select'), '');

        $daily_challenge_comment_flag = DailyChallengeCommentFlag::findOrFail($id);

        return view('admin.daily_challenge_comment_flags.edit', compact('daily_challenge_comment_flag', 'users', 'daily_challenge_comments'));
    }

    /**
     * Update DailyChallengeCommentFlag in storage.
     *
     * @param  \App\Http\Requests\UpdateDailyChallengeCommentFlagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDailyChallengeCommentFlagsRequest $request, $id)
    {
        if (! Gate::allows('daily_challenge_comment_flag_edit')) {
            return abort(401);
        }
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::findOrFail($id);
        $daily_challenge_comment_flag->update($request->all());



        return redirect()->route('admin.daily_challenge_comment_flags.index');
    }


    /**
     * Display DailyChallengeCommentFlag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('daily_challenge_comment_flag_view')) {
            return abort(401);
        }
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::findOrFail($id);

        return view('admin.daily_challenge_comment_flags.show', compact('daily_challenge_comment_flag'));
    }


    /**
     * Remove DailyChallengeCommentFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('daily_challenge_comment_flag_delete')) {
            return abort(401);
        }
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::findOrFail($id);
        $daily_challenge_comment_flag->delete();

        return redirect()->route('admin.daily_challenge_comment_flags.index');
    }

    /**
     * Delete all selected DailyChallengeCommentFlag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('daily_challenge_comment_flag_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DailyChallengeCommentFlag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DailyChallengeCommentFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('daily_challenge_comment_flag_delete')) {
            return abort(401);
        }
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::onlyTrashed()->findOrFail($id);
        $daily_challenge_comment_flag->restore();

        return redirect()->route('admin.daily_challenge_comment_flags.index');
    }

    /**
     * Permanently delete DailyChallengeCommentFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('daily_challenge_comment_flag_delete')) {
            return abort(401);
        }
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::onlyTrashed()->findOrFail($id);
        $daily_challenge_comment_flag->forceDelete();

        return redirect()->route('admin.daily_challenge_comment_flags.index');
    }
}
