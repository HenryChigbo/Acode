<?php

namespace App\Http\Controllers\Api\V1;

use App\DailyChallenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengesRequest;
use App\Http\Requests\Admin\UpdateDailyChallengesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class DailyChallengesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return DailyChallenge::all();
    }

    public function show($id)
    {
        return DailyChallenge::findOrFail($id);
    }

    public function update(UpdateDailyChallengesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $daily_challenge = DailyChallenge::findOrFail($id);
        $daily_challenge->update($request->all());
        

        return $daily_challenge;
    }

    public function store(StoreDailyChallengesRequest $request)
    {
        $request = $this->saveFiles($request);
        $daily_challenge = DailyChallenge::create($request->all());
        

        return $daily_challenge;
    }

    public function destroy($id)
    {
        $daily_challenge = DailyChallenge::findOrFail($id);
        $daily_challenge->delete();
        return '';
    }
}
