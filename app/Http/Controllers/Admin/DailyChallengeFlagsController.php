<?php

namespace App\Http\Controllers\Admin;

use App\DailyChallengeFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDailyChallengeFlagsRequest;
use App\Http\Requests\Admin\UpdateDailyChallengeFlagsRequest;

class DailyChallengeFlagsController extends Controller
{
    /**
     * Display a listing of DailyChallengeFlag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('daily_challenge_flag_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('daily_challenge_flag_delete')) {
                return abort(401);
            }
            $daily_challenge_flags = DailyChallengeFlag::onlyTrashed()->get();
        } else {
            $daily_challenge_flags = DailyChallengeFlag::all();
        }

        return view('admin.daily_challenge_flags.index', compact('daily_challenge_flags'));
    }

    /**
     * Show the form for creating new DailyChallengeFlag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('daily_challenge_flag_create')) {
            return abort(401);
        }
        
        $daily_challenges = \App\DailyChallenge::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.daily_challenge_flags.create', compact('daily_challenges'));
    }

    /**
     * Store a newly created DailyChallengeFlag in storage.
     *
     * @param  \App\Http\Requests\StoreDailyChallengeFlagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDailyChallengeFlagsRequest $request)
    {
        if (! Gate::allows('daily_challenge_flag_create')) {
            return abort(401);
        }
        $daily_challenge_flag = DailyChallengeFlag::create($request->all());



        return redirect()->route('admin.daily_challenge_flags.index');
    }


    /**
     * Show the form for editing DailyChallengeFlag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('daily_challenge_flag_edit')) {
            return abort(401);
        }
        
        $daily_challenges = \App\DailyChallenge::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $daily_challenge_flag = DailyChallengeFlag::findOrFail($id);

        return view('admin.daily_challenge_flags.edit', compact('daily_challenge_flag', 'daily_challenges'));
    }

    /**
     * Update DailyChallengeFlag in storage.
     *
     * @param  \App\Http\Requests\UpdateDailyChallengeFlagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDailyChallengeFlagsRequest $request, $id)
    {
        if (! Gate::allows('daily_challenge_flag_edit')) {
            return abort(401);
        }
        $daily_challenge_flag = DailyChallengeFlag::findOrFail($id);
        $daily_challenge_flag->update($request->all());



        return redirect()->route('admin.daily_challenge_flags.index');
    }


    /**
     * Display DailyChallengeFlag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('daily_challenge_flag_view')) {
            return abort(401);
        }
        $daily_challenge_flag = DailyChallengeFlag::findOrFail($id);

        return view('admin.daily_challenge_flags.show', compact('daily_challenge_flag'));
    }


    /**
     * Remove DailyChallengeFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('daily_challenge_flag_delete')) {
            return abort(401);
        }
        $daily_challenge_flag = DailyChallengeFlag::findOrFail($id);
        $daily_challenge_flag->delete();

        return redirect()->route('admin.daily_challenge_flags.index');
    }

    /**
     * Delete all selected DailyChallengeFlag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('daily_challenge_flag_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DailyChallengeFlag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DailyChallengeFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('daily_challenge_flag_delete')) {
            return abort(401);
        }
        $daily_challenge_flag = DailyChallengeFlag::onlyTrashed()->findOrFail($id);
        $daily_challenge_flag->restore();

        return redirect()->route('admin.daily_challenge_flags.index');
    }

    /**
     * Permanently delete DailyChallengeFlag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('daily_challenge_flag_delete')) {
            return abort(401);
        }
        $daily_challenge_flag = DailyChallengeFlag::onlyTrashed()->findOrFail($id);
        $daily_challenge_flag->forceDelete();

        return redirect()->route('admin.daily_challenge_flags.index');
    }
}
