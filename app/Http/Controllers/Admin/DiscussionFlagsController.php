<?php

namespace App\Http\Controllers\Admin;

use App\DiscussionFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionFlagsRequest;
use App\Http\Requests\Admin\UpdateDiscussionFlagsRequest;

class DiscussionFlagsController extends Controller
{
    /**
     * Display a listing of DiscussionFlag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('discussion_flag_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('discussion_flag_delete')) {
                return abort(401);
            }
            $discussion_flags = DiscussionFlag::onlyTrashed()->get();
        } else {
            $discussion_flags = DiscussionFlag::all();
        }

        return view('admin.discussion_flags.index', compact('discussion_flags'));
    }

    /**
     * Show the form for creating new DiscussionFlag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('discussion_flag_create')) {
            return abort(401);
        }
        
        $discussions = \App\Discussion::get()->pluck('question', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.discussion_flags.create', compact('discussions', 'users'));
    }

    /**
     * Store a newly created DiscussionFlag in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionFlagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionFlagsRequest $request)
    {
        if (! Gate::allows('discussion_flag_create')) {
            return abort(401);
        }
        $discussion_flag = DiscussionFlag::create($request->all());



        return redirect()->route('admin.discussion_flags.index');
    }


    /**
     * Show the form for editing DiscussionFlag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('discussion_flag_edit')) {
            return abort(401);
        }
        
        $discussions = \App\Discussion::get()->pluck('question', 'id')->prepend(trans('global.app_please_select'), '');
        $users = \App\User::get()->pluck('email', 'id')->prepend(trans('global.app_please_select'), '');

        $discussion_flag = DiscussionFlag::findOrFail($id);

        return view('admin.discussion_flags.edit', compact('discussion_flag', 'discussions', 'users'));
    }

    /**
     * Update DiscussionFlag in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionFlagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionFlagsRequest $request, $id)
    {
        if (! Gate::allows('discussion_flag_edit')) {
            return abort(401);
        }
        $discussion_flag = DiscussionFlag::findOrFail($id);
        $discussion_flag->update($request->all());



        return redirect()->route('admin.discussion_flags.index');
    }


    /**
     * Display DiscussionFlag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('discussion_flag_view')) {
            return abort(401);
        }
        $discussion_flag = DiscussionFlag::findOrFail($id);

        return view('admin.discussion_flags.show', compact('discussion_flag'));
    }


    /**
     * Remove DiscussionFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('discussion_flag_delete')) {
            return abort(401);
        }
        $discussion_flag = DiscussionFlag::findOrFail($id);
        $discussion_flag->delete();

        return redirect()->route('admin.discussion_flags.index');
    }

    /**
     * Delete all selected DiscussionFlag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('discussion_flag_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DiscussionFlag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DiscussionFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('discussion_flag_delete')) {
            return abort(401);
        }
        $discussion_flag = DiscussionFlag::onlyTrashed()->findOrFail($id);
        $discussion_flag->restore();

        return redirect()->route('admin.discussion_flags.index');
    }

    /**
     * Permanently delete DiscussionFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('discussion_flag_delete')) {
            return abort(401);
        }
        $discussion_flag = DiscussionFlag::onlyTrashed()->findOrFail($id);
        $discussion_flag->forceDelete();

        return redirect()->route('admin.discussion_flags.index');
    }
}
