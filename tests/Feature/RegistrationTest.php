<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test registration form screen can be rendered.
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Registrasi User');
    }

    /**
     * Test new user can register.
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Check redirect to home
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success', 'Registrasi berhasil! User telah berhasil ditambahkan.');

        // Check user creation in database
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Verify password is encrypted with bcrypt (Laravel's default Hash)
        $user = User::where('email', 'test@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /**
     * Test registration fails with invalid inputs.
     */
    public function test_registration_fails_with_invalid_inputs(): void
    {
        $response = $this->post('/register', [
            'name' => '', // Required name missing
            'email' => 'invalid-email', // Invalid email format
            'password' => 'short', // Too short
            'password_confirmation' => 'different', // Password confirmation mismatch
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertDatabaseCount('users', 0);
    }
}
