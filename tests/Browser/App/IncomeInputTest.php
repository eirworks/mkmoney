<?php

namespace Tests\Browser\App;

use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IncomeInputTest extends DuskTestCase
{
    public function test_input_income()
    {
        $this->browse(function (Browser $browser) {
            $store = Store::factory()->create();
            $category = Category::factory()->create(['store_id' => $store->id]);
            $subcategory = Category::factory()->create(['parent_id' => $category->id, 'store_id' => $store->id]);
            $user = User::first();
            $this->assertEquals(0, $store->transactions()->count());
            $browser
                ->loginAs($user)
                ->visit(route('stores::income::index', [$store]))
                ->assertSee('Pendapatan')
                ->value('#purchased_at', now()->format('Y-m-d'))
                ->value("#category_id", $subcategory->id)
                ->value('#amount', 50000)
                ->value('#qty', 1)
                ->screenshot("1")
                ->click('@submit_trx')
                ->pause(2000)
                ->screenshot("2")
            ;
            $this->assertEquals(1, $store->transactions()->count());
        });
    }
}
