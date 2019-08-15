<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LessonTest extends DuskTestCase
{

    public function testCreateLesson()
    {
        $admin = \App\User::find(1);
        $lesson = factory('App\Lesson')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $lesson) {
            $browser->loginAs($admin)
                ->visit(route('admin.lessons.index'))
                ->clickLink('Add new')
                ->type("name", $lesson->name)
                ->type("description", $lesson->description)
                ->type("content", $lesson->content)
                ->type("prerequisite", $lesson->prerequisite)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->type("color_background", $lesson->color_background)
                ->type("color_foreground", $lesson->color_foreground)
                ->press('Save')
                ->assertRouteIs('admin.lessons.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $lesson->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $lesson->description)
                ->assertSeeIn("tr:last-child td[field-key='content']", $lesson->content)
                ->assertSeeIn("tr:last-child td[field-key='prerequisite']", $lesson->prerequisite)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Lesson::first()->avatar . "']")
                ->assertSeeIn("tr:last-child td[field-key='color_background']", $lesson->color_background)
                ->assertSeeIn("tr:last-child td[field-key='color_foreground']", $lesson->color_foreground)
                ->logout();
        });
    }

    public function testEditLesson()
    {
        $admin = \App\User::find(1);
        $lesson = factory('App\Lesson')->create();
        $lesson2 = factory('App\Lesson')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $lesson, $lesson2) {
            $browser->loginAs($admin)
                ->visit(route('admin.lessons.index'))
                ->click('tr[data-entry-id="' . $lesson->id . '"] .btn-info')
                ->type("name", $lesson2->name)
                ->type("description", $lesson2->description)
                ->type("content", $lesson2->content)
                ->type("prerequisite", $lesson2->prerequisite)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->type("color_background", $lesson2->color_background)
                ->type("color_foreground", $lesson2->color_foreground)
                ->press('Update')
                ->assertRouteIs('admin.lessons.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $lesson2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $lesson2->description)
                ->assertSeeIn("tr:last-child td[field-key='content']", $lesson2->content)
                ->assertSeeIn("tr:last-child td[field-key='prerequisite']", $lesson2->prerequisite)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Lesson::first()->avatar . "']")
                ->assertSeeIn("tr:last-child td[field-key='color_background']", $lesson2->color_background)
                ->assertSeeIn("tr:last-child td[field-key='color_foreground']", $lesson2->color_foreground)
                ->logout();
        });
    }

    public function testShowLesson()
    {
        $admin = \App\User::find(1);
        $lesson = factory('App\Lesson')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $lesson) {
            $browser->loginAs($admin)
                ->visit(route('admin.lessons.index'))
                ->click('tr[data-entry-id="' . $lesson->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $lesson->name)
                ->assertSeeIn("td[field-key='description']", $lesson->description)
                ->assertSeeIn("td[field-key='content']", $lesson->content)
                ->assertSeeIn("td[field-key='prerequisite']", $lesson->prerequisite)
                ->assertSeeIn("td[field-key='color_background']", $lesson->color_background)
                ->assertSeeIn("td[field-key='color_foreground']", $lesson->color_foreground)
                ->logout();
        });
    }

}
