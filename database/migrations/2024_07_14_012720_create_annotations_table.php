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
        Schema::create('annotations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('content');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities')
                ->cascadeOnDelete();
        });

        Schema::create('annotation_files', function (Blueprint $table) {
            $table->id();
            $table->string('path', 500);
            $table->unsignedBigInteger('annotation_id');
            $table->timestamps();

            $table->foreign('annotation_id')->references('id')->on('annotations')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annotation_files');
        Schema::dropIfExists('annotations');
    }
};
