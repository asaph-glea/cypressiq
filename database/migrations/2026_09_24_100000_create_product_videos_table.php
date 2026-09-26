<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_videos', function (Blueprint $table) {
            $table->id();
            $table->string('product_key')->unique(); // 'opero', 'itikia', 'solutions'
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('video_url');
            $table->text('poster_url')->nullable();
            $table->boolean('autoplay')->default(true);
            $table->boolean('loop')->default(true);
            $table->boolean('muted')->default(true);
            $table->timestamps();
        });

        // Pre-seed initial default video loops and posters
        DB::table('product_videos')->insert([
            [
                'product_key' => 'opero',
                'title'       => 'OPERO — Business Operations & Management ERP',
                'subtitle'    => 'Enterprise POS, Multi-Location Inventory, Biometric HR & Real-Time Financials',
                'video_url'   => '/videos/opero-loop.mp4',
                'poster_url'  => '/images/mockups/opero-poster.webp',
                'autoplay'    => true,
                'loop'        => true,
                'muted'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_key' => 'itikia',
                'title'       => 'ITIKIA — Digital Engagement & Public Communication Platform',
                'subtitle'    => 'Civic Campaign Infrastructure, Manifesto Management & Grassroots Mobilization',
                'video_url'   => '/videos/itikia-loop.mp4',
                'poster_url'  => '/images/mockups/itikia-poster.webp',
                'autoplay'    => true,
                'loop'        => true,
                'muted'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'product_key' => 'solutions',
                'title'       => 'CypressIQ — Bespoke Enterprise Software & Systems Architecture',
                'subtitle'    => 'High-Concurrency APIs, Cloud Native Infrastructure & Distributed System Telemetry',
                'video_url'   => '/videos/solutions-loop.mp4',
                'poster_url'  => '/images/mockups/solutions-poster.webp',
                'autoplay'    => true,
                'loop'        => true,
                'muted'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_videos');
    }
};
