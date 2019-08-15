<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BannerTest extends DuskTestCase
{

    public function testCreateBanner()
    {
        $admin = \App\User::find(1);
        $banner = factory('App\Banner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $banner) {
            $browser->loginAs($admin)
                ->visit(route('admin.banners.index'))
                ->clickLink('Add new')
                ->attach("photo_one", base_path("tests/_resources/test.jpg"))
                ->attach("photo_two", base_path("tests/_resources/test.jpg"))
                ->attach("photo_three", base_path("tests/_resources/test.jpg"))
                ->attach("photo_four", base_path("tests/_resources/test.jpg"))
                ->attach("photo_five", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.banners.index')
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_one . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_two . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_three . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_four . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_five . "']")
                ->logout();
        });
    }

    public function testEditBanner()
    {
        $admin = \App\User::find(1);
        $banner = factory('App\Banner')->create();
        $banner2 = factory('App\Banner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $banner, $banner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.banners.index'))
                ->click('tr[data-entry-id="' . $banner->id . '"] .btn-info')
                ->attach("photo_one", base_path("tests/_resources/test.jpg"))
                ->attach("photo_two", base_path("tests/_resources/test.jpg"))
                ->attach("photo_three", base_path("tests/_resources/test.jpg"))
                ->attach("photo_four", base_path("tests/_resources/test.jpg"))
                ->attach("photo_five", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.banners.index')
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_one . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_two . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_three . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_four . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Banner::first()->photo_five . "']")
                ->logout();
        });
    }

    public function testShowBanner()
    {
        $admin = \App\User::find(1);
        $banner = factory('App\Banner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $banner) {
            $browser->loginAs($admin)
                ->visit(route('admin.banners.index'))
                ->click('tr[data-entry-id="' . $banner->id . '"] .btn-primary')

                ->logout();
        });
    }

}
