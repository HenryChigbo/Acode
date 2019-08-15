<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DailyChallengeCommentFlagTest extends DuskTestCase
{

    public function testCreateDailyChallengeCommentFlag()
    {
        $admin = \App\User::find(1);
        $daily_challenge_comment_flag = factory('App\DailyChallengeCommentFlag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_comment_flag) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_comment_flags.index'))
                ->clickLink('Add new')
                ->type("counter", $daily_challenge_comment_flag->counter)
                ->select("user_id", $daily_challenge_comment_flag->user_id)
                ->select("daily_challenge_comment_id", $daily_challenge_comment_flag->daily_challenge_comment_id)
                ->press('Save')
                ->assertRouteIs('admin.daily_challenge_comment_flags.index')
                ->assertSeeIn("tr:last-child td[field-key='counter']", $daily_challenge_comment_flag->counter)
                ->assertSeeIn("tr:last-child td[field-key='user']", $daily_challenge_comment_flag->user->email)
                ->assertSeeIn("tr:last-child td[field-key='daily_challenge_comment']", $daily_challenge_comment_flag->daily_challenge_comment->comment)
                ->logout();
        });
    }

    public function testEditDailyChallengeCommentFlag()
    {
        $admin = \App\User::find(1);
        $daily_challenge_comment_flag = factory('App\DailyChallengeCommentFlag')->create();
        $daily_challenge_comment_flag2 = factory('App\DailyChallengeCommentFlag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_comment_flag, $daily_challenge_comment_flag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_comment_flags.index'))
                ->click('tr[data-entry-id="' . $daily_challenge_comment_flag->id . '"] .btn-info')
                ->type("counter", $daily_challenge_comment_flag2->counter)
                ->select("user_id", $daily_challenge_comment_flag2->user_id)
                ->select("daily_challenge_comment_id", $daily_challenge_comment_flag2->daily_challenge_comment_id)
                ->press('Update')
                ->assertRouteIs('admin.daily_challenge_comment_flags.index')
                ->assertSeeIn("tr:last-child td[field-key='counter']", $daily_challenge_comment_flag2->counter)
                ->assertSeeIn("tr:last-child td[field-key='user']", $daily_challenge_comment_flag2->user->email)
                ->assertSeeIn("tr:last-child td[field-key='daily_challenge_comment']", $daily_challenge_comment_flag2->daily_challenge_comment->comment)
                ->logout();
        });
    }

    public function testShowDailyChallengeCommentFlag()
    {
        $admin = \App\User::find(1);
        $daily_challenge_comment_flag = factory('App\DailyChallengeCommentFlag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_comment_flag) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_comment_flags.index'))
                ->click('tr[data-entry-id="' . $daily_challenge_comment_flag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='counter']", $daily_challenge_comment_flag->counter)
                ->assertSeeIn("td[field-key='user']", $daily_challenge_comment_flag->user->email)
                ->assertSeeIn("td[field-key='daily_challenge_comment']", $daily_challenge_comment_flag->daily_challenge_comment->comment)
                ->logout();
        });
    }

}
