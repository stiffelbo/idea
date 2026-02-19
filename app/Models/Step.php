<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StepFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Step extends Model
{
    /** @use HasFactory<StepFactory> */
    use HasFactory;

    #[Override]
    protected function casts(): array
    {
        return [
            'completed' => 'boolean',
        ];
    }

    protected $attributes = ['completed' => false];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}
