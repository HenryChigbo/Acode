<?php

namespace App\Http\Controllers\Admin;

use App\DiscussionComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionCommentsRequest;
use App\Http\Requests\Admin\UpdateDiscussionCommentsRequest;

class DiscussionCommentsController extends Controller
{
    /**
     * Display a listing of DiscussionComment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('discussion_comment_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('discussion_comment_delete')) {
                return abort(401);
            }
            $discussion_comments = DiscussionComment::onlyTrashed()->get();
        } else {
            $discussion_comments = DiscussionComment::all();
        }

        return view('admin.discussion_comments.index', compact('discussion_comments'));
    }

    /**
     * Show the form for creating new DiscussionComment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('discussion_comment_create')) {
            return abort(401);
        }
        
        $discussions = \App\Discussion::get()->pluck('question', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.discussion_comments.create', compact('discussions', 'users'));
    }

    /**
     * Store a newly created DiscussionComment in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionCommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionCommentsRequest $request)
    {
        if (! Gate::allows('discussion_comment_create')) {
            return abort(401);
        }
        $discussion_comment = DiscussionComment::create($request->all());



        return redirect()->route('admin.discussion_comments.index');
    }


    /**
     * Show the form for editing DiscussionComment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('discussion_comment_edit')) {
            return abort(401);
        }
        
        $discussions = \App\Discussion::get()->pluck('question', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');

        $discussion_comment = DiscussionComment::findOrFail($id);

        return view('admin.discussion_comments.edit', compact('discussion_comment', 'discussions', 'users'));
    }

    /**
     * Update DiscussionComment in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionCommentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionCommentsRequest $request, $id)
    {
        if (! Gate::allows('discussion_comment_edit')) {
            return abort(401);
        }
        $discussion_comment = DiscussionComment::findOrFail($id);
        $discussion_comment->update($request->all());



        return redirect()->route('admin.discussion_comments.index');
    }


    /**
     * Display DiscussionComment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('discussion_comment_view')) {
            return abort(401);
        }
        $discussion_comment = DiscussionComment::findOrFail($id);

        return view('admin.discussion_comments.show', compact('discussion_comment'));
    }


    /**
     * Remove DiscussionComment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('discussion_comment_delete')) {
            return abort(401);
        }
        $discussion_comment = DiscussionComment::findOrFail($id);
        $discussion_comment->delete();

        return redirect()->route('admin.discussion_comments.index');
    }

    /**
     * Delete all selected DiscussionComment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('discussion_comment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DiscussionComment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DiscussionComment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('discussion_comment_delete')) {
            return abort(401);
        }
        $discussion_comment = DiscussionComment::onlyTrashed()->findOrFail($id);
        $discussion_comment->restore();

        return redirect()->route('admin.discussion_comments.index');
    }

    /**
     * Permanently delete DiscussionComment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('discussion_comment_delete')) {
            return abort(401);
        }
        $discussion_comment = DiscussionComment::onlyTrashed()->findOrFail($id);
        $discussion_comment->forceDelete();

        return redirect()->route('admin.discussion_comments.index');
    }
}
