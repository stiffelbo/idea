<?php

use App\Models\User;

test('shows registration form', function () {
    visit('/register')
        ->assertPathIs('/register')
        ->assertPresent('@submit')
        ->assertPresent('input[name="name"]')
        ->assertPresent('input[name="email"]')
        ->assertPresent('input[name="password"]');
});

test('requires a valid email', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john')
        ->fill('password', 'password1234567')
        ->click('@submit')
        ->assertPathIs('/register');
});

test('registers a user', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'john@example.com')
        ->fill('password', 'password1234567')
        ->click('@submit')
        ->assertPathIs('/');

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', ['name' => 'John Doe']);
});

test('does not register a user with duplicate email', function () {
    User::factory()->create([
        'email' => 'john@example.com',
    ]);

    visit('/register')
        ->fill('name', 'Another John')
        ->fill('email', 'john@example.com')
        ->fill('password', 'password1234567')
        ->click('@submit')
        ->assertPathIs('/register');

    $this->assertGuest();
    expect(User::query()->where('email', 'john@example.com')->count())->toBe(1);
});

test('keeps old email and does not create user when password is invalid', function () {
    visit('/register')
        ->fill('name', 'John Doe')
        ->fill('email', 'invalid-password@example.com')
        ->fill('password', 'short')
        ->click('@submit')
        ->assertPathIs('/register')
        ->assertValue('email', 'invalid-password@example.com');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'invalid-password@example.com']);
});

test('redirects authenticated users away from register page', function () {
    $this->actingAs(User::factory()->create());

    visit('/register')->assertPathIs('/');
});
