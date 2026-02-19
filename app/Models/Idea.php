<?php

declare(strict_types=1);

namespace App\Models;

use App\IdeaStatus;
use Database\Factories\IdeaFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Idea extends Model
{
    /** @use HasFactory<IdeaFactory> */
    use HasFactory;

    protected $casts = [
        'links' => AsArrayObject::class,
        'status' => IdeaStatus::class,
    ];

    protected $attributes = [
        'status' => IdeaStatus::PENDING->value,
    ];

    public static function statusCounts(User $user): Collection
    {
        // counts per status for THIS user
        $statusCounts = $user->ideas()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'); // => ['pending' => 3, 'done' => 1]

        // ensure all enum cases exist with 0 fallback
        return collect(IdeaStatus::cases())
            ->mapWithKeys(fn (IdeaStatus $status) => [
                $status->value => (int) ($statusCounts[$status->value] ?? 0),
            ])
            ->put('all', $user->ideas()->count());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
