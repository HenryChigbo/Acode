<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DailyChallengeFlagTest extends DuskTestCase
{

    public function testCreateDailyChallengeFlag()
    {
        $admin = \App\User::find(1);
        $daily_challenge_flag = factory('App\DailyChallengeFlag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_flag) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_flags.index'))
                ->clickLink('Add new')
                ->type("counter", $daily_challenge_flag->counter)
                ->select("daily_challenge_id", $daily_challenge_flag->daily_challenge_id)
                ->press('Save')
                ->assertRouteIs('admin.daily_challenge_flags.index')
                ->assertSeeIn("tr:last-child td[field-key='counter']", $daily_challenge_flag->counter)
                ->assertSeeIn("tr:last-child td[field-key='daily_challenge']", $daily_challenge_flag->daily_challenge->name)
                ->logout();
        });
    }

    public function testEditDailyChallengeFlag()
    {
        $admin = \App\User::find(1);
        $daily_challenge_flag = factory('App\DailyChallengeFlag')->create();
        $daily_challenge_flag2 = factory('App\DailyChallengeFlag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_flag, $daily_challenge_flag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_flags.index'))
                ->click('tr[data-entry-id="' . $daily_challenge_flag->id . '"] .btn-info')
                ->type("counter", $daily_challenge_flag2->counter)
                ->select("daily_challenge_id", $daily_challenge_flag2->daily_challenge_id)
                ->press('Update')
                ->assertRouteIs('admin.daily_challenge_flags.index')
                ->assertSeeIn("tr:last-child td[field-key='counter']", $daily_challenge_flag2->counter)
                ->assertSeeIn("tr:last-child td[field-key='daily_challenge']", $daily_challenge_flag2->daily_challenge->name)
                ->logout();
        });
    }

    public function testShowDailyChallengeFlag()
    {
        $admin = \App\User::find(1);
        $daily_challenge_flag = factory('App\DailyChallengeFlag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_flag) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_flags.index'))
                ->click('tr[data-entry-id="' . $daily_challenge_flag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='counter']", $daily_challenge_flag->counter)
                ->assertSeeIn("td[field-key='daily_challenge']", $daily_challenge_flag->daily_challenge->name)
                ->logout();
        });
    }

}
