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
        Schema::create('goals', function (Blueprint $table) {
            $table->uuid('uuid')->first();
            $table->uuid('user_uuid');
            $table->string('name');
            $table->float('weight_goal', 6, 2);
            $table->integer('rep_goal');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
