<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'role',
        'action',
        'description',
        'entity_type',
        'entity_id',
        'properties',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'properties' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record an audit activity entry.
     */
    public static function record(
        string $action,
        string $description,
        ?Model $entity = null,
        array $properties = [],
        ?User $user = null
    ): self {
        $currentUser = $user ?: Auth::user();

        return self::create([
            'user_id'     => $currentUser?->id,
            'user_name'   => $currentUser?->name ?? 'Guest / Anonymous',
            'user_email'  => $currentUser?->email ?? ($properties['attempted_email'] ?? null),
            'role'        => $currentUser?->role ?? 'guest',
            'action'      => $action,
            'description' => $description,
            'entity_type' => $entity ? get_class($entity) : null,
            'entity_id'   => $entity?->getKey(),
            'properties'  => !empty($properties) ? $properties : null,
            'ip_address'  => Request::ip(),
            'user_agent'  => Request::userAgent(),
            'created_at'  => now(),
        ]);
    }
}
