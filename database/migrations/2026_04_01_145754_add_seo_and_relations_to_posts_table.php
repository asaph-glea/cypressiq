<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('status');
            $table->string('meta_description', 500)->nullable()->after('meta_title');
            
            // Note: Depending on existing category/user setup these could be foreign keys,
            // but for simplicity assuming they are just unsigned integers initially.
            // If the categories/users tables exist, we can constrain them.
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete()->after('id');
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete()->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['author_id']);
            $table->dropColumn(['category_id', 'author_id', 'meta_title', 'meta_description']);
        });
    }
};
