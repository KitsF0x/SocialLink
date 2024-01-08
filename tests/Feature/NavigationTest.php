<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    public function test_WhenAuthenticated_ShouldRenderProfileNameAndLogoutLinks()
    {
        $this->post(route('auth.register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => "Password1234",
            'password_confirmation' => "Password1234",
        ]));

        $response = $this->get(route('home.index'));

        $response->assertOk();
        $response->assertSee("Logout");
        $response->assertSee(Auth::user()->name);
        
    }
}
