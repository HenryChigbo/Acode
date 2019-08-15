<?php

namespace App\Http\Controllers\Api\V1;

use App\DiscussionFlag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionFlagsRequest;
use App\Http\Requests\Admin\UpdateDiscussionFlagsRequest;

class DiscussionFlagsController extends Controller
{
    public function index()
    {
        return DiscussionFlag::all();
    }

    public function show($id)
    {
        return DiscussionFlag::findOrFail($id);
    }

    public function update(UpdateDiscussionFlagsRequest $request, $id)
    {
        $discussion_flag = DiscussionFlag::findOrFail($id);
        $discussion_flag->update($request->all());
        

        return $discussion_flag;
    }

    public function store(StoreDiscussionFlagsRequest $request)
    {
        $discussion_flag = DiscussionFlag::create($request->all());
        

        return $discussion_flag;
    }

    public function destroy($id)
    {
        $discussion_flag = DiscussionFlag::findOrFail($id);
        $discussion_flag->delete();
        return '';
    }
}
