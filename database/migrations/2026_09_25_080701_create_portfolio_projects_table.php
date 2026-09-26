<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name')->nullable();
            $table->string('industry')->nullable();              // e.g. "Retail", "Healthcare"
            $table->string('category');                          // e.g. "Web App", "Business System"
            $table->text('summary');                             // short description (card)
            $table->longText('description')->nullable();         // full case study body
            $table->string('cover_image')->nullable();
            $table->json('gallery_images')->nullable();          // array of image paths
            $table->json('technologies')->nullable();            // ["Laravel", "Vue.js", ...]
            $table->json('outcomes')->nullable();                // ["40% reduction in...", ...]
            $table->string('project_url')->nullable();
            $table->string('duration')->nullable();              // e.g. "3 months"
            $table->date('completed_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_projects');
    }
};
