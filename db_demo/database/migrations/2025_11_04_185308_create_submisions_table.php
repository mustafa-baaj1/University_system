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
        Schema::create('submisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("assignment_id")->constrained("assignments")->cascadeOnDelete();
            $table->foreignId("student_id")->constrained("students")->cascadeOnDelete();
            $table->string("file");
            $table->dateTime("submitted_at");
            $table->string("status")->default("pending");
            $table->string("feedback");
            $table->string("feedback_comment");
            $table->string("score");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submisions');
    }
};
