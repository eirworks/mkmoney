<?php

namespace Tests\Browser\App;

use App\Http\Livewire\TransactionInput;
use App\Models\Category;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IncomeInputTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Store::truncate();
        Category::truncate();
        Transaction::truncate();
    }

    public function test_input_income()
    {
        $this->browse(function (Browser $browser) {
            $store = Store::factory()->create();
            $category = Category::factory()->create(['store_id' => $store->id]);
            $subcategory = Category::factory()->create(['parent_id' => $category->id, 'store_id' => $store->id]);
            $user = User::first();
            $this->assertEquals(0, $store->transactions()->count());
            $this->actingAs($user);
            \Livewire::test(TransactionInput::class, [
                'store' => $store
            ])
                ->set('expenditure', false)
                ->set('category_id', $subcategory->id)
                ->set('amount', 50000)
                ->set('qty', 1)
                ->call('submitTransaction');
            $this->assertEquals(1, $store->transactions()->count());
        });
    }
}
