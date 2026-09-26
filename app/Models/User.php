<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_GROWTH = 'growth';
    public const ROLE_PRODUCT_ENGINEER = 'product_engineer';

    /**
     * Default attribute values.
     */
    protected $attributes = [
        'role'      => self::ROLE_SUPER_ADMIN,
        'is_active' => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'role',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
            'is_active'         => 'boolean',
            'last_login_at'     => 'datetime',
        ];
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN || ($this->is_admin && empty($this->role));
    }

    public function isGrowth(): bool
    {
        return $this->role === self::ROLE_GROWTH;
    }

    public function isProductEngineer(): bool
    {
        return $this->role === self::ROLE_PRODUCT_ENGINEER;
    }

    public function roleLabel(): string
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN      => 'Super Admin',
            self::ROLE_GROWTH           => 'Growth & Marketing',
            self::ROLE_PRODUCT_ENGINEER => 'Product & Engineering',
            default                     => ucfirst(str_replace('_', ' ', $this->role ?? 'User')),
        };
    }

    public function roleBadgeClass(): string
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN      => 'badge--primary',
            self::ROLE_GROWTH           => 'badge--accent',
            self::ROLE_PRODUCT_ENGINEER => 'badge--warning',
            default                     => 'badge--secondary',
        };
    }

    /**
     * Check whether this user has permission to access a specific admin panel.
     */
    public function canAccessPanel(string $panel): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return in_array($panel, $this->allowedPanels(), true);
    }

    /**
     * List of panels accessible by this user based on departmental role.
     */
    public function allowedPanels(): array
    {
        if ($this->isSuperAdmin()) {
            return [
                'dashboard',
                'leads',
                'messages',
                'bookings',
                'itikia',
                'opero',
                'posts',
                'editor',
                'videos',
                'media',
                'testimonials',
                'trust-projects',
                'partnerships',
                'contact-settings',
                'seo',
                'settings',
                'team',
                'audit',
            ];
        }

        if ($this->isGrowth()) {
            return [
                'dashboard',
                'leads',
                'messages',
                'bookings',
                'posts',
                'editor',
                'testimonials',
                'trust-projects',
                'partnerships',
                'contact-settings',
                'seo',
            ];
        }

        if ($this->isProductEngineer()) {
            return [
                'dashboard',
                'itikia',
                'opero',
                'videos',
                'media',
                'settings',
            ];
        }

        return ['dashboard'];
    }
}

