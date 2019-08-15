<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserLessonTest extends DuskTestCase
{

    public function testCreateUserLesson()
    {
        $admin = \App\User::find(1);
        $user_lesson = factory('App\UserLesson')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $user_lesson) {
            $browser->loginAs($admin)
                ->visit(route('admin.user_lessons.index'))
                ->clickLink('Add new')
                ->select("users_id", $user_lesson->users_id)
                ->select("lesson_id", $user_lesson->lesson_id)
                ->press('Save')
                ->assertRouteIs('admin.user_lessons.index')
                ->assertSeeIn("tr:last-child td[field-key='users']", $user_lesson->users->email)
                ->assertSeeIn("tr:last-child td[field-key='lesson']", $user_lesson->lesson->name)
                ->logout();
        });
    }

    public function testEditUserLesson()
    {
        $admin = \App\User::find(1);
        $user_lesson = factory('App\UserLesson')->create();
        $user_lesson2 = factory('App\UserLesson')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $user_lesson, $user_lesson2) {
            $browser->loginAs($admin)
                ->visit(route('admin.user_lessons.index'))
                ->click('tr[data-entry-id="' . $user_lesson->id . '"] .btn-info')
                ->select("users_id", $user_lesson2->users_id)
                ->select("lesson_id", $user_lesson2->lesson_id)
                ->press('Update')
                ->assertRouteIs('admin.user_lessons.index')
                ->assertSeeIn("tr:last-child td[field-key='users']", $user_lesson2->users->email)
                ->assertSeeIn("tr:last-child td[field-key='lesson']", $user_lesson2->lesson->name)
                ->logout();
        });
    }

    public function testShowUserLesson()
    {
        $admin = \App\User::find(1);
        $user_lesson = factory('App\UserLesson')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $user_lesson) {
            $browser->loginAs($admin)
                ->visit(route('admin.user_lessons.index'))
                ->click('tr[data-entry-id="' . $user_lesson->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='users']", $user_lesson->users->email)
                ->assertSeeIn("td[field-key='lesson']", $user_lesson->lesson->name)
                ->logout();
        });
    }

}
