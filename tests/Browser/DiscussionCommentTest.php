<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DiscussionCommentTest extends DuskTestCase
{

    public function testCreateDiscussionComment()
    {
        $admin = \App\User::find(1);
        $discussion_comment = factory('App\DiscussionComment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion_comment) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_comments.index'))
                ->clickLink('Add new')
                ->type("comment", $discussion_comment->comment)
                ->select("discussion_id", $discussion_comment->discussion_id)
                ->select("user_id", $discussion_comment->user_id)
                ->press('Save')
                ->assertRouteIs('admin.discussion_comments.index')
                ->assertSeeIn("tr:last-child td[field-key='comment']", $discussion_comment->comment)
                ->assertSeeIn("tr:last-child td[field-key='discussion']", $discussion_comment->discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='user']", $discussion_comment->user->email)
                ->logout();
        });
    }

    public function testEditDiscussionComment()
    {
        $admin = \App\User::find(1);
        $discussion_comment = factory('App\DiscussionComment')->create();
        $discussion_comment2 = factory('App\DiscussionComment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $discussion_comment, $discussion_comment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_comments.index'))
                ->click('tr[data-entry-id="' . $discussion_comment->id . '"] .btn-info')
                ->type("comment", $discussion_comment2->comment)
                ->select("discussion_id", $discussion_comment2->discussion_id)
                ->select("user_id", $discussion_comment2->user_id)
                ->press('Update')
                ->assertRouteIs('admin.discussion_comments.index')
                ->assertSeeIn("tr:last-child td[field-key='comment']", $discussion_comment2->comment)
                ->assertSeeIn("tr:last-child td[field-key='discussion']", $discussion_comment2->discussion->question)
                ->assertSeeIn("tr:last-child td[field-key='user']", $discussion_comment2->user->email)
                ->logout();
        });
    }

    public function testShowDiscussionComment()
    {
        $admin = \App\User::find(1);
        $discussion_comment = factory('App\DiscussionComment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $discussion_comment) {
            $browser->loginAs($admin)
                ->visit(route('admin.discussion_comments.index'))
                ->click('tr[data-entry-id="' . $discussion_comment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='comment']", $discussion_comment->comment)
                ->assertSeeIn("td[field-key='discussion']", $discussion_comment->discussion->question)
                ->assertSeeIn("td[field-key='user']", $discussion_comment->user->email)
                ->logout();
        });
    }

}
