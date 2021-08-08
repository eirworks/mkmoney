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
    protected function setUp(): void
    {
        parent::setUp();
        Category::truncate();
        Store::truncate();
    }

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
                ->assertValue("#expenditure", "")
                ->click("@submit")
                ->assertSee($category->name)
            ;

            $latestCategory = Category::latest()->first();
            $latestCategory->is_expenditure = false;
        });
    }

    public function test_create_category_for_expenditure()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $store = Store::factory()->create();
            $category = Category::factory()->make();
            $browser->loginAs($user)
                ->visit(route('stores::categories::create', [$store, 'type' => 'expenditure']))
                ->value('@parent_id', "0")
                ->value("#name", $category->name)
                ->value("#description", $category->description)
                ->value("#color", $category->color)
                ->assertValue("#expenditure", "1")
                ->click("@submit")
                ->assertSee($category->name)
            ;
            $latestCategory = Category::latest()->first();
            $latestCategory->is_expenditure = true;
        });
    }

    public function test_create_category_with_empty_desc()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $store = Store::factory()->create();
            $category = Category::factory()->make();
            $browser->loginAs($user)
                ->visit(route('stores::categories::create', [$store]))
                ->value('@parent_id', "0")
                ->value("#name", $category->name)
                ->value("#description", "")
                ->value("#color", "")
                ->screenshot("1")
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

    public function test_create_subcategory_with_empty_desc()
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
                ->value("#description", "")
                ->value("#color", "")
                ->screenshot("1.5")
                ->click("@submit")
                ->assertSee($category->name)
                ->screenshot("2")
            ;

            $latestCat = Category::latest('id')->first();
            $this->assertEquals($category->name, $latestCat->name);
            $this->assertEquals($parent_category->id, $latestCat->parent_id);
        });
    }
}
