<?php

namespace App\Http\Controllers\Admin;

use App\DiscussionViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionViewersRequest;
use App\Http\Requests\Admin\UpdateDiscussionViewersRequest;

class DiscussionViewersController extends Controller
{
    /**
     * Display a listing of DiscussionViewer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('discussion_viewer_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('discussion_viewer_delete')) {
                return abort(401);
            }
            $discussion_viewers = DiscussionViewer::onlyTrashed()->get();
        } else {
            $discussion_viewers = DiscussionViewer::all();
        }

        return view('admin.discussion_viewers.index', compact('discussion_viewers'));
    }

    /**
     * Show the form for creating new DiscussionViewer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('discussion_viewer_create')) {
            return abort(401);
        }
        
        $discussions = \App\Discussion::get()->pluck('question', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.discussion_viewers.create', compact('discussions'));
    }

    /**
     * Store a newly created DiscussionViewer in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionViewersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscussionViewersRequest $request)
    {
        if (! Gate::allows('discussion_viewer_create')) {
            return abort(401);
        }
        $discussion_viewer = DiscussionViewer::create($request->all());



        return redirect()->route('admin.discussion_viewers.index');
    }


    /**
     * Show the form for editing DiscussionViewer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('discussion_viewer_edit')) {
            return abort(401);
        }
        
        $discussions = \App\Discussion::get()->pluck('question', 'id')->prepend(trans('global.app_please_select'), '');

        $discussion_viewer = DiscussionViewer::findOrFail($id);

        return view('admin.discussion_viewers.edit', compact('discussion_viewer', 'discussions'));
    }

    /**
     * Update DiscussionViewer in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionViewersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionViewersRequest $request, $id)
    {
        if (! Gate::allows('discussion_viewer_edit')) {
            return abort(401);
        }
        $discussion_viewer = DiscussionViewer::findOrFail($id);
        $discussion_viewer->update($request->all());



        return redirect()->route('admin.discussion_viewers.index');
    }


    /**
     * Display DiscussionViewer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('discussion_viewer_view')) {
            return abort(401);
        }
        $discussion_viewer = DiscussionViewer::findOrFail($id);

        return view('admin.discussion_viewers.show', compact('discussion_viewer'));
    }


    /**
     * Remove DiscussionViewer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('discussion_viewer_delete')) {
            return abort(401);
        }
        $discussion_viewer = DiscussionViewer::findOrFail($id);
        $discussion_viewer->delete();

        return redirect()->route('admin.discussion_viewers.index');
    }

    /**
     * Delete all selected DiscussionViewer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('discussion_viewer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DiscussionViewer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DiscussionViewer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('discussion_viewer_delete')) {
            return abort(401);
        }
        $discussion_viewer = DiscussionViewer::onlyTrashed()->findOrFail($id);
        $discussion_viewer->restore();

        return redirect()->route('admin.discussion_viewers.index');
    }

    /**
     * Permanently delete DiscussionViewer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('discussion_viewer_delete')) {
            return abort(401);
        }
        $discussion_viewer = DiscussionViewer::onlyTrashed()->findOrFail($id);
        $discussion_viewer->forceDelete();

        return redirect()->route('admin.discussion_viewers.index');
    }
}
