<?php

namespace App\Http\Controllers\Api\V1;

use App\DiscussionViewer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionViewersRequest;
use App\Http\Requests\Admin\UpdateDiscussionViewersRequest;

class DiscussionViewersController extends Controller
{
    public function index()
    {
        return DiscussionViewer::all();
    }

    public function show($id)
    {
        return DiscussionViewer::findOrFail($id);
    }

    public function update(UpdateDiscussionViewersRequest $request, $id)
    {
        $discussion_viewer = DiscussionViewer::findOrFail($id);
        $discussion_viewer->update($request->all());
        

        return $discussion_viewer;
    }

    public function store(StoreDiscussionViewersRequest $request)
    {
        $discussion_viewer = DiscussionViewer::create($request->all());
        

        return $discussion_viewer;
    }

    public function destroy($id)
    {
        $discussion_viewer = DiscussionViewer::findOrFail($id);
        $discussion_viewer->delete();
        return '';
    }
}
