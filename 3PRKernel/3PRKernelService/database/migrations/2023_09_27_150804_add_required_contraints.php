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
        Schema::table('goals', function (Blueprint $table) {
            $table->uuid('user_uuid')->required()->change();
            $table->string('name')->required()->change();
            $table->float('weight_goal', 6, 2)->required()->change();
            $table->integer('rep_goal')->required()->change();
        });

        Schema::table('progression_set_plans', function (Blueprint $table) {
            $table->uuid('goal_uuid')->required()->change();
            $table->float('weight', 6, 2)->required()->change();
            $table->integer('set_number')->required()->change();
            $table->integer('reps')->required()->change();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->uuid('user_uuid')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->float('weight_goal', 6, 2)->nullable()->change();
            $table->integer('rep_goal')->nullable()->change();
        });

        Schema::table('progression_set_plans', function (Blueprint $table) {
            $table->uuid('goal_uuid')->nullable()->change();
            $table->float('weight', 6, 2)->nullable()->change();
            $table->integer('set_number')->nullable()->change();
            $table->integer('reps')->nullable()->change();
        });
    }
};
