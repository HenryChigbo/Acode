<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DailyChallengeCommentTest extends DuskTestCase
{

    public function testCreateDailyChallengeComment()
    {
        $admin = \App\User::find(1);
        $daily_challenge_comment = factory('App\DailyChallengeComment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_comment) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_comments.index'))
                ->clickLink('Add new')
                ->type("comment", $daily_challenge_comment->comment)
                ->select("daily_challenge_id", $daily_challenge_comment->daily_challenge_id)
                ->select("user_id", $daily_challenge_comment->user_id)
                ->press('Save')
                ->assertRouteIs('admin.daily_challenge_comments.index')
                ->assertSeeIn("tr:last-child td[field-key='comment']", $daily_challenge_comment->comment)
                ->assertSeeIn("tr:last-child td[field-key='daily_challenge']", $daily_challenge_comment->daily_challenge->name)
                ->assertSeeIn("tr:last-child td[field-key='user']", $daily_challenge_comment->user->email)
                ->logout();
        });
    }

    public function testEditDailyChallengeComment()
    {
        $admin = \App\User::find(1);
        $daily_challenge_comment = factory('App\DailyChallengeComment')->create();
        $daily_challenge_comment2 = factory('App\DailyChallengeComment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_comment, $daily_challenge_comment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_comments.index'))
                ->click('tr[data-entry-id="' . $daily_challenge_comment->id . '"] .btn-info')
                ->type("comment", $daily_challenge_comment2->comment)
                ->select("daily_challenge_id", $daily_challenge_comment2->daily_challenge_id)
                ->select("user_id", $daily_challenge_comment2->user_id)
                ->press('Update')
                ->assertRouteIs('admin.daily_challenge_comments.index')
                ->assertSeeIn("tr:last-child td[field-key='comment']", $daily_challenge_comment2->comment)
                ->assertSeeIn("tr:last-child td[field-key='daily_challenge']", $daily_challenge_comment2->daily_challenge->name)
                ->assertSeeIn("tr:last-child td[field-key='user']", $daily_challenge_comment2->user->email)
                ->logout();
        });
    }

    public function testShowDailyChallengeComment()
    {
        $admin = \App\User::find(1);
        $daily_challenge_comment = factory('App\DailyChallengeComment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $daily_challenge_comment) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenge_comments.index'))
                ->click('tr[data-entry-id="' . $daily_challenge_comment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='comment']", $daily_challenge_comment->comment)
                ->assertSeeIn("td[field-key='daily_challenge']", $daily_challenge_comment->daily_challenge->name)
                ->assertSeeIn("td[field-key='user']", $daily_challenge_comment->user->email)
                ->logout();
        });
    }

}
