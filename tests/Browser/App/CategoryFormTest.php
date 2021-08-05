<?php

namespace Tests\Browser\App;

use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryFormTest extends DuskTestCase
{
    public function test_create_category()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $store = Store::factory()->create();
            $category = Category::factory()->make();
            $browser->loginAs($user)
                ->visit(route('stores::categories::create', [$store]))
                ->value('@parent_id', "0")
                ->value("#name", $category->name)
                ->value("#description", $category->description)
                ->value("#color", $category->color)
                ->click("@submit")
                ->assertSee($category->name)
            ;
        });
    }

    public function test_create_subcategory()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $store = Store::factory()->create();
            $parent_category = Category::factory()->create(['store_id' => $store->id]);
            $category = Category::factory()->make();
            $browser->loginAs($user)
                ->visit(route('stores::categories::create', [$store]))
                ->select('parent_id', strval($parent_category->id))
                ->screenshot("1")
                ->value("#name", $category->name)
                ->value("#description", $category->description)
                ->value("#color", $category->color)
                ->click("@submit")
                ->assertSee($category->name)
                ->screenshot("2")
            ;

            $latestCat = Category::latest('id')->first();
            $this->assertEquals($parent_category->id, $latestCat->parent_id);
        });
    }
}