<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DailyChallengeTest extends DuskTestCase
{

    public function testCreateDailyChallenge()
    {
        $admin = \App\User::find(1);
        $daily_challenge = factory('App\DailyChallenge')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenges.index'))
                ->clickLink('Add new')
                ->type("name", $daily_challenge->name)
                ->type("description", $daily_challenge->description)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.daily_challenges.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $daily_challenge->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $daily_challenge->description)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\DailyChallenge::first()->image . "']")
                ->logout();
        });
    }

    public function testEditDailyChallenge()
    {
        $admin = \App\User::find(1);
        $daily_challenge = factory('App\DailyChallenge')->create();
        $daily_challenge2 = factory('App\DailyChallenge')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $daily_challenge, $daily_challenge2) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenges.index'))
                ->click('tr[data-entry-id="' . $daily_challenge->id . '"] .btn-info')
                ->type("name", $daily_challenge2->name)
                ->type("description", $daily_challenge2->description)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.daily_challenges.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $daily_challenge2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $daily_challenge2->description)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\DailyChallenge::first()->image . "']")
                ->logout();
        });
    }

    public function testShowDailyChallenge()
    {
        $admin = \App\User::find(1);
        $daily_challenge = factory('App\DailyChallenge')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $daily_challenge) {
            $browser->loginAs($admin)
                ->visit(route('admin.daily_challenges.index'))
                ->click('tr[data-entry-id="' . $daily_challenge->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $daily_challenge->name)
                ->assertSeeIn("td[field-key='description']", $daily_challenge->description)
                ->logout();
        });
    }

}
