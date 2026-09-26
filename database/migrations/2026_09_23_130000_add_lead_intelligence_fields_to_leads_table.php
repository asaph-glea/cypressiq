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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('name')->nullable()->after('email');
            $table->string('phone')->nullable()->after('name');
            $table->string('company')->nullable()->after('phone');
            $table->string('project_type')->nullable()->after('company');
            $table->string('project_scale')->nullable()->after('project_type');
            $table->text('bottleneck')->nullable()->after('project_scale');
            $table->string('timeline')->nullable()->after('bottleneck');
            $table->text('message')->nullable()->after('timeline');
            $table->string('product_interest')->nullable()->after('message');
            $table->string('status')->default('new')->after('product_interest');
            $table->string('priority')->default('medium')->after('status');
            $table->text('notes')->nullable()->after('priority');
            $table->string('assigned_to')->nullable()->after('notes');
            $table->timestamp('last_contacted_at')->nullable()->after('assigned_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'phone',
                'company',
                'project_type',
                'project_scale',
                'bottleneck',
                'timeline',
                'message',
                'product_interest',
                'status',
                'priority',
                'notes',
                'assigned_to',
                'last_contacted_at',
            ]);
        });
    }
};
