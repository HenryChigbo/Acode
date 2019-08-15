<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CourseTest extends DuskTestCase
{

    public function testCreateCourse()
    {
        $admin = \App\User::find(1);
        $course = factory('App\Course')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $course) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->clickLink('Add new')
                ->type("name", $course->name)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->type("key", $course->key)
                ->press('Save')
                ->assertRouteIs('admin.courses.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $course->name)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Course::first()->image . "']")
                ->assertSeeIn("tr:last-child td[field-key='key']", $course->key)
                ->logout();
        });
    }

    public function testEditCourse()
    {
        $admin = \App\User::find(1);
        $course = factory('App\Course')->create();
        $course2 = factory('App\Course')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $course, $course2) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->click('tr[data-entry-id="' . $course->id . '"] .btn-info')
                ->type("name", $course2->name)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->type("key", $course2->key)
                ->press('Update')
                ->assertRouteIs('admin.courses.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $course2->name)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Course::first()->image . "']")
                ->assertSeeIn("tr:last-child td[field-key='key']", $course2->key)
                ->logout();
        });
    }

    public function testShowCourse()
    {
        $admin = \App\User::find(1);
        $course = factory('App\Course')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $course) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->click('tr[data-entry-id="' . $course->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $course->name)
                ->assertSeeIn("td[field-key='key']", $course->key)
                ->logout();
        });
    }

}
