<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DiscussionTest extends DuskTestCase
{

    public function testCreateDiscussion()
    {
        $admin = \App\User::find(1);
        $discussion = factory('App\Discussion')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussions.index'))
                ->clickLink('Add new')
                ->type("question", $discussion->question)
                ->select("tags", $discussion->tags)
                ->type("description", $discussion->description)
                ->type("post", $discussion->post)
                ->select("user_id", $discussion->user_id)
                ->press('Save')
                ->assertRouteIs('admin.discussions.index')
                ->assertSeeIn("tr:last-child td[field-key='question']", $discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='tags']", $discussion->tags)
                ->assertSeeIn("tr:last-child td[field-key='description']", $discussion->description)
                ->assertSeeIn("tr:last-child td[field-key='post']", $discussion->post)
                ->assertSeeIn("tr:last-child td[field-key='user']", $discussion->user->email)
                ->logout();
        });
    }

    public function testEditDiscussion()
    {
        $admin = \App\User::find(1);
        $discussion = factory('App\Discussion')->create();
        $discussion2 = factory('App\Discussion')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion, $discussion2) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussions.index'))
                ->click('tr[data-entry-id="' . $discussion->id . '"] .btn-info')
                ->type("question", $discussion2->question)
                ->select("tags", $discussion2->tags)
                ->type("description", $discussion2->description)
                ->type("post", $discussion2->post)
                ->select("user_id", $discussion2->user_id)
                ->press('Update')
                ->assertRouteIs('admin.discussions.index')
                ->assertSeeIn("tr:last-child td[field-key='question']", $discussion2->question)
                ->assertSeeIn("tr:last-child td[field-key='tags']", $discussion2->tags)
                ->assertSeeIn("tr:last-child td[field-key='description']", $discussion2->description)
                ->assertSeeIn("tr:last-child td[field-key='post']", $discussion2->post)
                ->assertSeeIn("tr:last-child td[field-key='user']", $discussion2->user->email)
                ->logout();
        });
    }

    public function testShowDiscussion()
    {
        $admin = \App\User::find(1);
        $discussion = factory('App\Discussion')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $discussion) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussions.index'))
                ->click('tr[data-entry-id="' . $discussion->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='question']", $discussion->question)
                ->assertSeeIn("td[field-key='tags']", $discussion->tags)
                ->assertSeeIn("td[field-key='description']", $discussion->description)
                ->assertSeeIn("td[field-key='post']", $discussion->post)
                ->assertSeeIn("td[field-key='user']", $discussion->user->email)
                ->logout();
        });
    }

}
