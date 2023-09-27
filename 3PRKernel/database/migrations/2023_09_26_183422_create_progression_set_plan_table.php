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
        Schema::create('progression_set_plans', function (Blueprint $table) {
            $table->uuid('uuid')->first();
            $table->foreignUuid('goal_uuid')->constrained('goals', 'uuid');
            $table->float('weight', 6, 2);
            $table->integer('set_number');
            $table->integer('reps');
            $table->enum("type", ['percentage', 'weight']);
            $table->timestamps();

            $table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progression_set_plans');
    }
};
