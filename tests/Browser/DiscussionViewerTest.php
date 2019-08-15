<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DiscussionViewerTest extends DuskTestCase
{

    public function testCreateDiscussionViewer()
    {
        $admin = \App\User::find(1);
        $discussion_viewer = factory('App\DiscussionViewer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion_viewer) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_viewers.index'))
                ->clickLink('Add new')
                ->select("discussion_id", $discussion_viewer->discussion_id)
                ->type("counter", $discussion_viewer->counter)
                ->press('Save')
                ->assertRouteIs('admin.discussion_viewers.index')
                ->assertSeeIn("tr:last-child td[field-key='discussion']", $discussion_viewer->discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='counter']", $discussion_viewer->counter)
                ->logout();
        });
    }

    public function testEditDiscussionViewer()
    {
        $admin = \App\User::find(1);
        $discussion_viewer = factory('App\DiscussionViewer')->create();
        $discussion_viewer2 = factory('App\DiscussionViewer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion_viewer, $discussion_viewer2) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_viewers.index'))
                ->click('tr[data-entry-id="' . $discussion_viewer->id . '"] .btn-info')
                ->select("discussion_id", $discussion_viewer2->discussion_id)
                ->type("counter", $discussion_viewer2->counter)
                ->press('Update')
                ->assertRouteIs('admin.discussion_viewers.index')
                ->assertSeeIn("tr:last-child td[field-key='discussion']", $discussion_viewer2->discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='counter']", $discussion_viewer2->counter)
                ->logout();
        });
    }

    public function testShowDiscussionViewer()
    {
        $admin = \App\User::find(1);
        $discussion_viewer = factory('App\DiscussionViewer')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $discussion_viewer) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_viewers.index'))
                ->click('tr[data-entry-id="' . $discussion_viewer->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='discussion']", $discussion_viewer->discussion->question)
                ->assertSeeIn("td[field-key='counter']", $discussion_viewer->counter)
                ->logout();
        });
    }

}
