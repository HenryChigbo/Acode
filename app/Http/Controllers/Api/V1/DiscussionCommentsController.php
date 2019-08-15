<?php

namespace App\Http\Controllers\Api\V1;

use App\DiscussionComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionCommentsRequest;
use App\Http\Requests\Admin\UpdateDiscussionCommentsRequest;

class DiscussionCommentsController extends Controller
{
    public function index()
    {
        return DiscussionComment::all();
    }

    public function show($id)
    {
        return DiscussionComment::findOrFail($id);
    }

    public function update(UpdateDiscussionCommentsRequest $request, $id)
    {
        $discussion_comment = DiscussionComment::findOrFail($id);
        $discussion_comment->update($request->all());
        

        return $discussion_comment;
    }

    public function store(StoreDiscussionCommentsRequest $request)
    {
        $discussion_comment = DiscussionComment::create($request->all());
        

        return $discussion_comment;
    }

    public function destroy($id)
    {
        $discussion_comment = DiscussionComment::findOrFail($id);
        $discussion_comment->delete();
        return '';
    }
}
