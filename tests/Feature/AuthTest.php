<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    public function test_WhenCalledRoute_AuthRegisterForm_ShouldRenderRegistrationForm()
    {
        $response = $this->get(route('auth.registerForm'));

        $response->assertViewIs('auth.register');
    }
    public function test_WhenCalledRoute_AuthLoginForm_ShouldRenderLoginForm()
    {
        $response = $this->get(route('auth.loginForm'));

        $response->assertViewIs('auth.login');
    }

    public function test_WhenCalledRoute_AuthRegister_WithValidData_ShouldCreateNewUser() 
    {
        $password = $this->faker->password;
        $response = $this->post(route('auth.register'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $this->assertCount(1, User::all());
    }

    public function test_WhenCalledRoute_AuthRegister_WithValidData_ShouldLoginNewUser() 
    {
        $password = $this->faker->password;
        $this->post(route('auth.register'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $this->assertAuthenticated();
    }

    public function test_WhenCalledRoute_AuthRegister_WithInvalidName_ShouldSetErrorInSession() 
    {
        $password = $this->faker->password;
        $response = $this->post(route('auth.register'), [
            'name' => "xd",
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $response->assertSessionHasErrors("name");
    }
    public function test_WhenCalledRoute_AuthRegister_WithInvalidEmail_ShouldSetErrorInSession() 
    {
        $password = $this->faker->password;
        $response = $this->post(route('auth.register'), [
            'name' => $this->faker->name,
            'email' => "qwerty",
            'password' => $password,
            'password_confirmation' => $password
        ]);

        $response->assertSessionHasErrors("email");
    }
    public function test_WhenCalledRoute_AuthRegister_WithInvalidPassword_ShouldSetErrorInSession() 
    {
        $response = $this->post(route('auth.register'), [
            'name' => $this->faker->name,
            'email' => "qwerty",
            'password' => "123",
            'password_confirmation' => "123"
        ]);

        $response->assertSessionHasErrors("password");
    }
    public function test_WhenCalledRoute_AuthRegister_WithInvalidPasswordConfirmation_ShouldSetErrorInSession() 
    {
        $response = $this->post(route('auth.register'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => "123456",
            'password_confirmation' => "1234567"
        ]);

        $response->assertSessionHasErrors("password_confirmation");
    }

    public function test_WhenCalledRoute_AuthLogin_WithValidData_ShouldLoginUser() 
    {
        $user = User::create([
            'name' => $this->faker->name, 
            'email' => $this->faker->email, 
            'password' => Hash::make("Password1234"),
            'password_confirmation' => Hash::make("Password1234"),
        ]);

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => "Password1234"
        ]);

        $response->assertRedirect(route('home.index'));
        $this->assertAuthenticated();
    }
    public function test_WhenCalledRoute_AuthLogin_WithInvalidEmailData_ShouldSetErrorInSession() 
    {
        $user = User::create([
            'name' => $this->faker->name, 
            'email' => $this->faker->email, 
            'password' => Hash::make("Password1234"),
            'password_confirmation' => Hash::make("Password1234"),
        ]);

        $response = $this->post(route('auth.login'), [
            'email' => "abc@gmail.com",
            'password' => "Password1234"
        ]);

        $response->assertSessionHasErrors("error");
        $this->assertGuest();
    }
    public function test_WhenCalledRoute_AuthLogin_WithInvalidPasswordData_ShouldSetErrorInSession() 
    {
        $user = User::create([
            'name' => $this->faker->name, 
            'email' => $this->faker->email, 
            'password' => Hash::make("Password1234"),
            'password_confirmation' => Hash::make("Password1234"),
        ]);

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => "Aaaaaa"
        ]);

        $response->assertSessionHasErrors("error");
        $this->assertGuest();
    }
}
