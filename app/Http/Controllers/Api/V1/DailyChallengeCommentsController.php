<?php

namespace App\Http\Controllers\Api\V1;

use App\DailyChallengeComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengeCommentsRequest;
use App\Http\Requests\Admin\UpdateDailyChallengeCommentsRequest;

class DailyChallengeCommentsController extends Controller
{
    public function index()
    {
        return DailyChallengeComment::all();
    }

    public function show($id)
    {
        return DailyChallengeComment::findOrFail($id);
    }

    public function update(UpdateDailyChallengeCommentsRequest $request, $id)
    {
        $daily_challenge_comment = DailyChallengeComment::findOrFail($id);
        $daily_challenge_comment->update($request->all());
        

        return $daily_challenge_comment;
    }

    public function store(StoreDailyChallengeCommentsRequest $request)
    {
        $daily_challenge_comment = DailyChallengeComment::create($request->all());
        

        return $daily_challenge_comment;
    }

    public function destroy($id)
    {
        $daily_challenge_comment = DailyChallengeComment::findOrFail($id);
        $daily_challenge_comment->delete();
        return '';
    }
}
