<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_key',
        'title',
        'subtitle',
        'video_url',
        'poster_url',
        'autoplay',
        'loop',
        'muted',
    ];

    protected $casts = [
        'autoplay' => 'boolean',
        'loop'     => 'boolean',
        'muted'    => 'boolean',
    ];

    /**
     * Default fallbacks if the database table has not yet been seeded or row is missing.
     */
    protected static array $defaults = [
        'opero' => [
            'product_key' => 'opero',
            'title'       => 'OPERO — Business Operations & Management ERP',
            'subtitle'    => 'Enterprise POS, Multi-Location Inventory, Biometric HR & Real-Time Financials',
            'video_url'   => '/videos/opero-loop.mp4',
            'poster_url'  => '/images/mockups/opero-poster.webp',
            'autoplay'    => true,
            'loop'        => true,
            'muted'       => true,
        ],
        'itikia' => [
            'product_key' => 'itikia',
            'title'       => 'ITIKIA — Digital Engagement & Public Communication Platform',
            'subtitle'    => 'Civic Campaign Infrastructure, Manifesto Management & Grassroots Mobilization',
            'video_url'   => '/videos/itikia-loop.mp4',
            'poster_url'  => '/images/mockups/itikia-poster.webp',
            'autoplay'    => true,
            'loop'        => true,
            'muted'       => true,
        ],
        'solutions' => [
            'product_key' => 'solutions',
            'title'       => 'CypressIQ — Bespoke Enterprise Software & Systems Architecture',
            'subtitle'    => 'High-Concurrency APIs, Cloud Native Infrastructure & Distributed System Telemetry',
            'video_url'   => '/videos/solutions-loop.mp4',
            'poster_url'  => '/images/mockups/solutions-poster.webp',
            'autoplay'    => true,
            'loop'        => true,
            'muted'       => true,
        ],
    ];

    /**
     * Retrieve a product video by key with automatic default fallback.
     */
    public static function getVideo(string $key): self
    {
        try {
            $record = static::where('product_key', $key)->first();
            if ($record) {
                return $record;
            }
        } catch (\Throwable $e) {
            // In case of migration in flight or table not ready, return fallback instance
        }

        $fallbackData = static::$defaults[$key] ?? [
            'product_key' => $key,
            'title'       => ucfirst($key) . ' Product Walkthrough',
            'subtitle'    => 'CypressIQ Engineering Walkthrough',
            'video_url'   => "/videos/{$key}-loop.mp4",
            'poster_url'  => "/images/mockups/{$key}-poster.webp",
            'autoplay'    => true,
            'loop'        => true,
            'muted'       => true,
        ];

        return new static($fallbackData);
    }

    /**
     * Return all product videos indexed by product_key.
     *
     * @return array<string, self>
     */
    public static function allAsMap(): array
    {
        $map = [];
        $keys = ['opero', 'itikia', 'solutions'];

        try {
            $records = static::whereIn('product_key', $keys)->get()->keyBy('product_key');
            foreach ($keys as $key) {
                $map[$key] = $records->get($key) ?? static::getVideo($key);
            }
        } catch (\Throwable $e) {
            foreach ($keys as $key) {
                $map[$key] = static::getVideo($key);
            }
        }

        return $map;
    }
}
