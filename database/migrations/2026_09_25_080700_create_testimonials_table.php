<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_role')->nullable();           // e.g. "CEO"
            $table->string('client_company')->nullable();        // e.g. "Acme Ltd"
            $table->string('client_avatar')->nullable();         // file path or URL
            $table->text('quote');                               // the testimonial text
            $table->tinyInteger('rating')->default(5);           // 1–5 stars
            $table->string('product_or_solution')->nullable();   // e.g. "Opero", "Custom Software"
            $table->boolean('is_featured')->default(false);      // show on homepage
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
