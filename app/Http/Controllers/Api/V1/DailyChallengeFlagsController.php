<?php

namespace App\Http\Controllers\Api\V1;

use App\DailyChallengeFlag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengeFlagsRequest;
use App\Http\Requests\Admin\UpdateDailyChallengeFlagsRequest;

class DailyChallengeFlagsController extends Controller
{
    public function index()
    {
        return DailyChallengeFlag::all();
    }

    public function show($id)
    {
        return DailyChallengeFlag::findOrFail($id);
    }

    public function update(UpdateDailyChallengeFlagsRequest $request, $id)
    {
        $daily_challenge_flag = DailyChallengeFlag::findOrFail($id);
        $daily_challenge_flag->update($request->all());
        

        return $daily_challenge_flag;
    }

    public function store(StoreDailyChallengeFlagsRequest $request)
    {
        $daily_challenge_flag = DailyChallengeFlag::create($request->all());
        

        return $daily_challenge_flag;
    }

    public function destroy($id)
    {
        $daily_challenge_flag = DailyChallengeFlag::findOrFail($id);
        $daily_challenge_flag->delete();
        return '';
    }
}
