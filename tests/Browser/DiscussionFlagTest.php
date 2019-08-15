<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DiscussionFlagTest extends DuskTestCase
{

    public function testCreateDiscussionFlag()
    {
        $admin = \App\User::find(1);
        $discussion_flag = factory('App\DiscussionFlag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion_flag) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_flags.index'))
                ->clickLink('Add new')
                ->select("discussion_id", $discussion_flag->discussion_id)
                ->select("user_id", $discussion_flag->user_id)
                ->type("counter", $discussion_flag->counter)
                ->press('Save')
                ->assertRouteIs('admin.discussion_flags.index')
                ->assertSeeIn("tr:last-child td[field-key='discussion']", $discussion_flag->discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='user']", $discussion_flag->user->email)
                ->assertSeeIn("tr:last-child td[field-key='counter']", $discussion_flag->counter)
                ->logout();
        });
    }

    public function testEditDiscussionFlag()
    {
        $admin = \App\User::find(1);
        $discussion_flag = factory('App\DiscussionFlag')->create();
        $discussion_flag2 = factory('App\DiscussionFlag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion_flag, $discussion_flag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_flags.index'))
                ->click('tr[data-entry-id="' . $discussion_flag->id . '"] .btn-info')
                ->select("discussion_id", $discussion_flag2->discussion_id)
                ->select("user_id", $discussion_flag2->user_id)
                ->type("counter", $discussion_flag2->counter)
                ->press('Update')
                ->assertRouteIs('admin.discussion_flags.index')
                ->assertSeeIn("tr:last-child td[field-key='discussion']", $discussion_flag2->discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='user']", $discussion_flag2->user->email)
                ->assertSeeIn("tr:last-child td[field-key='counter']", $discussion_flag2->counter)
                ->logout();
        });
    }

    public function testShowDiscussionFlag()
    {
        $admin = \App\User::find(1);
        $discussion_flag = factory('App\DiscussionFlag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $discussion_flag) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_flags.index'))
                ->click('tr[data-entry-id="' . $discussion_flag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='discussion']", $discussion_flag->discussion->question)
                ->assertSeeIn("td[field-key='user']", $discussion_flag->user->email)
                ->assertSeeIn("td[field-key='counter']", $discussion_flag->counter)
                ->logout();
        });
    }

}
