<?php

use App\IdeaStatus;
use App\Models\Idea;
use App\Models\Step;
use App\Models\User;

test('it belongs to a user', function () {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});

test('it has no steps by default', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)->toHaveCount(0);
});

test('it can have many steps', function () {
    $idea = Idea::factory()->create();
    Step::factory()->count(2)->create([
        'idea_id' => $idea->id,
    ]);

    expect($idea->fresh()->steps)
        ->toHaveCount(2)
        ->each->toBeInstanceOf(Step::class);
});

test('it casts links and status attributes', function () {
    $idea = Idea::factory()->create();

    expect($idea->links)->toBeInstanceOf(\ArrayObject::class)
        ->and($idea->status)->toBe(IdeaStatus::PENDING);
});
