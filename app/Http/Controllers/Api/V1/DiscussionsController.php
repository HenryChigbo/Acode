<?php

namespace App\Http\Controllers\Api\V1;

use App\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDiscussionsRequest;
use App\Http\Requests\Admin\UpdateDiscussionsRequest;

class DiscussionsController extends Controller
{
    public function index()
    {
        return Discussion::all();
    }

    public function show($id)
    {
        return Discussion::findOrFail($id);
    }

    public function update(UpdateDiscussionsRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());
        

        return $discussion;
    }

    public function store(StoreDiscussionsRequest $request)
    {
        $discussion = Discussion::create($request->all());
        

        return $discussion;
    }

    public function destroy($id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->delete();
        return '';
    }
}
