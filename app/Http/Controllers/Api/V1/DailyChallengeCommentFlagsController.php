<?php

namespace App\Http\Controllers\Api\V1;

use App\DailyChallengeCommentFlag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengeCommentFlagsRequest;
use App\Http\Requests\Admin\UpdateDailyChallengeCommentFlagsRequest;

class DailyChallengeCommentFlagsController extends Controller
{
    public function index()
    {
        return DailyChallengeCommentFlag::all();
    }

    public function show($id)
    {
        return DailyChallengeCommentFlag::findOrFail($id);
    }

    public function update(UpdateDailyChallengeCommentFlagsRequest $request, $id)
    {
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::findOrFail($id);
        $daily_challenge_comment_flag->update($request->all());
        

        return $daily_challenge_comment_flag;
    }

    public function store(StoreDailyChallengeCommentFlagsRequest $request)
    {
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::create($request->all());
        

        return $daily_challenge_comment_flag;
    }

    public function destroy($id)
    {
        $daily_challenge_comment_flag = DailyChallengeCommentFlag::findOrFail($id);
        $daily_challenge_comment_flag->delete();
        return '';
    }
}
