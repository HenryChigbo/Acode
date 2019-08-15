<?php

namespace App\Http\Controllers\Admin;

use App\DailyChallengeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengeCommentsRequest;
use App\Http\Requests\Admin\UpdateDailyChallengeCommentsRequest;

class DailyChallengeCommentsController extends Controller
{
    /**
     * Display a listing of DailyChallengeComment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('daily_challenge_comment_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('daily_challenge_comment_delete')) {
                return abort(401);
            }
            $daily_challenge_comments = DailyChallengeComment::onlyTrashed()->get();
        } else {
            $daily_challenge_comments = DailyChallengeComment::all();
        }

        return view('admin.daily_challenge_comments.index', compact('daily_challenge_comments'));
    }

    /**
     * Show the form for creating new DailyChallengeComment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('daily_challenge_comment_create')) {
            return abort(401);
        }
        
        $daily_challenges = \App\DailyChallenge::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.daily_challenge_comments.create', compact('daily_challenges', 'users'));
    }

    /**
     * Store a newly created DailyChallengeComment in storage.
     *
     * @param  \App\Http\Requests\StoreDailyChallengeCommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDailyChallengeCommentsRequest $request)
    {
        if (! Gate::allows('daily_challenge_comment_create')) {
            return abort(401);
        }
        $daily_challenge_comment = DailyChallengeComment::create($request->all());



        return redirect()->route('admin.daily_challenge_comments.index');
    }


    /**
     * Show the form for editing DailyChallengeComment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('daily_challenge_comment_edit')) {
            return abort(401);
        }
        
        $daily_challenges = \App\DailyChallenge::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');

        $daily_challenge_comment = DailyChallengeComment::findOrFail($id);

        return view('admin.daily_challenge_comments.edit', compact('daily_challenge_comment', 'daily_challenges', 'users'));
    }

    /**
     * Update DailyChallengeComment in storage.
     *
     * @param  \App\Http\Requests\UpdateDailyChallengeCommentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDailyChallengeCommentsRequest $request, $id)
    {
        if (! Gate::allows('daily_challenge_comment_edit')) {
            return abort(401);
        }
        $daily_challenge_comment = DailyChallengeComment::findOrFail($id);
        $daily_challenge_comment->update($request->all());



        return redirect()->route('admin.daily_challenge_comments.index');
    }


    /**
     * Display DailyChallengeComment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('daily_challenge_comment_view')) {
            return abort(401);
        }
        
        $daily_challenges = \App\DailyChallenge::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');$daily_challenge_comment_flags = \App\DailyChallengeCommentFlag::where('daily_challenge_comment_id', $id)->get();

        $daily_challenge_comment = DailyChallengeComment::findOrFail($id);

        return view('admin.daily_challenge_comments.show', compact('daily_challenge_comment', 'daily_challenge_comment_flags'));
    }


    /**
     * Remove DailyChallengeComment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('daily_challenge_comment_delete')) {
            return abort(401);
        }
        $daily_challenge_comment = DailyChallengeComment::findOrFail($id);
        $daily_challenge_comment->delete();

        return redirect()->route('admin.daily_challenge_comments.index');
    }

    /**
     * Delete all selected DailyChallengeComment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('daily_challenge_comment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DailyChallengeComment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DailyChallengeComment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('daily_challenge_comment_delete')) {
            return abort(401);
        }
        $daily_challenge_comment = DailyChallengeComment::onlyTrashed()->findOrFail($id);
        $daily_challenge_comment->restore();

        return redirect()->route('admin.daily_challenge_comments.index');
    }

    /**
     * Permanently delete DailyChallengeComment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('daily_challenge_comment_delete')) {
            return abort(401);
        }
        $daily_challenge_comment = DailyChallengeComment::onlyTrashed()->findOrFail($id);
        $daily_challenge_comment->forceDelete();

        return redirect()->route('admin.daily_challenge_comments.index');
    }
}
