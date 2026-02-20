<?php

use App\Models\Idea;
use App\Models\User;

it('can create an idea', function () {
    $this->actingAs($user = User::factory()->create());
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Create Idea')
        ->click('@button-status-completed')
        ->fill('description', 'Create Idea tetetete')
        ->fill('@newLink', 'https://laracasts.com')
        ->click('@add-newLink')
        ->fill('@newLink', 'https://laracasts2.com')
        ->click('@add-newLink')
        ->click('@create-idea')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'Create Idea',
        'description' => 'Create Idea tetetete',
        'status' => 'completed',
        'links' => ['https://laracasts.com', 'https://laracasts2.com'],
    ]);
});
