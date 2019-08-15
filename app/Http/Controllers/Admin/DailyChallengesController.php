<?php

namespace App\Http\Controllers\Admin;

use App\DailyChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengesRequest;
use App\Http\Requests\Admin\UpdateDailyChallengesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class DailyChallengesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of DailyChallenge.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('daily_challenge_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('daily_challenge_delete')) {
                return abort(401);
            }
            $daily_challenges = DailyChallenge::onlyTrashed()->get();
        } else {
            $daily_challenges = DailyChallenge::all();
        }

        return view('admin.daily_challenges.index', compact('daily_challenges'));
    }

    /**
     * Show the form for creating new DailyChallenge.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('daily_challenge_create')) {
            return abort(401);
        }
        return view('admin.daily_challenges.create');
    }

    /**
     * Store a newly created DailyChallenge in storage.
     *
     * @param  \App\Http\Requests\StoreDailyChallengesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDailyChallengesRequest $request)
    {
        if (! Gate::allows('daily_challenge_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $daily_challenge = DailyChallenge::create($request->all());



        return redirect()->route('admin.daily_challenges.index');
    }


    /**
     * Show the form for editing DailyChallenge.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('daily_challenge_edit')) {
            return abort(401);
        }
        $daily_challenge = DailyChallenge::findOrFail($id);

        return view('admin.daily_challenges.edit', compact('daily_challenge'));
    }

    /**
     * Update DailyChallenge in storage.
     *
     * @param  \App\Http\Requests\UpdateDailyChallengesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDailyChallengesRequest $request, $id)
    {
        if (! Gate::allows('daily_challenge_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $daily_challenge = DailyChallenge::findOrFail($id);
        $daily_challenge->update($request->all());



        return redirect()->route('admin.daily_challenges.index');
    }


    /**
     * Display DailyChallenge.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('daily_challenge_view')) {
            return abort(401);
        }
        $daily_challenge_flags = \App\DailyChallengeFlag::where('daily_challenge_id', $id)->get();$daily_challenge_comments = \App\DailyChallengeComment::where('daily_challenge_id', $id)->get();

        $daily_challenge = DailyChallenge::findOrFail($id);

        return view('admin.daily_challenges.show', compact('daily_challenge', 'daily_challenge_flags', 'daily_challenge_comments'));
    }


    /**
     * Remove DailyChallenge from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('daily_challenge_delete')) {
            return abort(401);
        }
        $daily_challenge = DailyChallenge::findOrFail($id);
        $daily_challenge->delete();

        return redirect()->route('admin.daily_challenges.index');
    }

    /**
     * Delete all selected DailyChallenge at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('daily_challenge_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DailyChallenge::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DailyChallenge from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('daily_challenge_delete')) {
            return abort(401);
        }
        $daily_challenge = DailyChallenge::onlyTrashed()->findOrFail($id);
        $daily_challenge->restore();

        return redirect()->route('admin.daily_challenges.index');
    }

    /**
     * Permanently delete DailyChallenge from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('daily_challenge_delete')) {
            return abort(401);
        }
        $daily_challenge = DailyChallenge::onlyTrashed()->findOrFail($id);
        $daily_challenge->forceDelete();

        return redirect()->route('admin.daily_challenges.index');
    }
}
