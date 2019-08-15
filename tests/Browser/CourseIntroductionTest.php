<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CourseIntroductionTest extends DuskTestCase
{

    public function testCreateCourseIntroduction()
    {
        $admin = \App\User::find(1);
        $course_introduction = factory('App\CourseIntroduction')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $course_introduction) {
            $browser->loginAs($admin)
                ->visit(route('admin.course_introductions.index'))
                ->clickLink('Add new')
                ->type("title", $course_introduction->title)
                ->type("description", $course_introduction->description)
                ->select("course_key_id", $course_introduction->course_key_id)
                ->press('Save')
                ->assertRouteIs('admin.course_introductions.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $course_introduction->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $course_introduction->description)
                ->assertSeeIn("tr:last-child td[field-key='course_key']", $course_introduction->course_key->name)
                ->logout();
        });
    }

    public function testEditCourseIntroduction()
    {
        $admin = \App\User::find(1);
        $course_introduction = factory('App\CourseIntroduction')->create();
        $course_introduction2 = factory('App\CourseIntroduction')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $course_introduction, $course_introduction2) {
            $browser->loginAs($admin)
                ->visit(route('admin.course_introductions.index'))
                ->click('tr[data-entry-id="' . $course_introduction->id . '"] .btn-info')
                ->type("title", $course_introduction2->title)
                ->type("description", $course_introduction2->description)
                ->select("course_key_id", $course_introduction2->course_key_id)
                ->press('Update')
                ->assertRouteIs('admin.course_introductions.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $course_introduction2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $course_introduction2->description)
                ->assertSeeIn("tr:last-child td[field-key='course_key']", $course_introduction2->course_key->name)
                ->logout();
        });
    }

    public function testShowCourseIntroduction()
    {
        $admin = \App\User::find(1);
        $course_introduction = factory('App\CourseIntroduction')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $course_introduction) {
            $browser->loginAs($admin)
                ->visit(route('admin.course_introductions.index'))
                ->click('tr[data-entry-id="' . $course_introduction->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $course_introduction->title)
                ->assertSeeIn("td[field-key='description']", $course_introduction->description)
                ->assertSeeIn("td[field-key='course_key']", $course_introduction->course_key->name)
                ->logout();
        });
    }

}
