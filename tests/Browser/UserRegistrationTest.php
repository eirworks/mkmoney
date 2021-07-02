<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserRegistrationTest extends DuskTestCase
{
    use WithFaker;
    public function test_user_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('auth::register'))
                ->assertSee('Daftar Akun')
                ->value('@name', $this->faker->name)
                ->value('@email', $this->faker->email)
                ->type('@password', $this->faker->hexColor)
                ->click('@register')
                ->assertSee("Selamat datang")
                ->screenshot("1")
                ;
        });
    }
}
