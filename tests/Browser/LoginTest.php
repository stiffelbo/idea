<?php

use App\Models\User;

test('logs in a user', function () {
    $user = User::factory()->create(
        [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password1234567',
        ]
    );
    visit('/login')
        ->fill('email', $user->email)
        ->fill('password', 'password1234567')
        ->click('@signin')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

test('logs out a user', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit('/')->click('@logout');

    $this->assertGuest();
});
