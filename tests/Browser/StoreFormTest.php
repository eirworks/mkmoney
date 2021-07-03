<?php

namespace Tests\Browser;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StoreFormTest extends DuskTestCase
{
    use WithFaker;

    public function test_store_form()
    {
        $this->browse(function (Browser $browser) {
            $shopName = "Toko ".$this->faker->colorName;
            $browser->loginAs(User::find(1))->visit(route('stores::create'))
                ->assertSee('Tambahkan bisnis')
                ->value('@name', $shopName)
                ->select('@type', "shop")
                ->attach("@image", resource_path('img.jpg'))
                ->screenshot("1")
                ->click('@submit')
                ->assertSee($shopName)
            ;
        });
    }

    public function test_store_edit_form()
    {
        $this->browse(function (Browser $browser) {
            $store = Store::factory()->create();
            $browser->loginAs(User::find(1))->visit(route('stores::edit', [$store]))
                ->value('@name', $store->name." EDIT")
                ->select('@type', "shop")
                ->attach("@image", resource_path('img.jpg'))
                ->screenshot("1")
                ->click('@submit')
                ->assertSee($store->name)
            ;
        });
    }
}
