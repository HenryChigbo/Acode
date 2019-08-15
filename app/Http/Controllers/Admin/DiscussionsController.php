<?php

namespace App\Http\Controllers\Admin;

use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionsRequest;
use App\Http\Requests\Admin\UpdateDiscussionsRequest;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of Discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('discussion_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('discussion_delete')) {
                return abort(401);
            }
            $discussions = Discussion::onlyTrashed()->get();
        } else {
            $discussions = Discussion::all();
        }

        return view('admin.discussions.index', compact('discussions'));
    }

    /**
     * Show the form for creating new Discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('discussion_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_tags = Discussion::$enum_tags;
            
        return view('admin.discussions.create', compact('enum_tags', 'users'));
    }

    /**
     * Store a newly created Discussion in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionsRequest $request)
    {
        if (! Gate::allows('discussion_create')) {
            return abort(401);
        }
        $discussion = Discussion::create($request->all());



        return redirect()->route('admin.discussions.index');
    }


    /**
     * Show the form for editing Discussion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('discussion_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_tags = Discussion::$enum_tags;
            
        $discussion = Discussion::findOrFail($id);

        return view('admin.discussions.edit', compact('discussion', 'enum_tags', 'users'));
    }

    /**
     * Update Discussion in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionsRequest $request, $id)
    {
        if (! Gate::allows('discussion_edit')) {
            return abort(401);
        }
        $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());



        return redirect()->route('admin.discussions.index');
    }


    /**
     * Display Discussion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('discussion_view')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');$discussion_flags = \App\DiscussionFlag::where('discussion_id', $id)->get();$discussion_viewers = \App\DiscussionViewer::where('discussion_id', $id)->get();$discussion_comments = \App\DiscussionComment::where('discussion_id', $id)->get();

        $discussion = Discussion::findOrFail($id);

        return view('admin.discussions.show', compact('discussion', 'discussion_flags', 'discussion_viewers', 'discussion_comments'));
    }


    /**
     * Remove Discussion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('discussion_delete')) {
            return abort(401);
        }
        $discussion = Discussion::findOrFail($id);
        $discussion->delete();

        return redirect()->route('admin.discussions.index');
    }

    /**
     * Delete all selected Discussion at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('discussion_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Discussion::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Discussion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('discussion_delete')) {
            return abort(401);
        }
        $discussion = Discussion::onlyTrashed()->findOrFail($id);
        $discussion->restore();

        return redirect()->route('admin.discussions.index');
    }

    /**
     * Permanently delete Discussion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('discussion_delete')) {
            return abort(401);
        }
        $discussion = Discussion::onlyTrashed()->findOrFail($id);
        $discussion->forceDelete();

        return redirect()->route('admin.discussions.index');
    }
}
