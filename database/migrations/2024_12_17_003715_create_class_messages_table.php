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
        Schema::create('class_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_rooms_id')->constrained()->cascadeOnDelete()->nullable();

            $table->unsignedBigInteger('sender_id')->nullable();// or uuid()
            $table->foreign('sender_id')->references('id')->on('users')->nullOnDelete();

            // $table->unsignedBigInteger('department_id')->nullable();// or uuid()
            // $table->foreign('department_id')->references('department')->on('class_rooms')->nullOnDelete();

            $table->text('body')->nullable();
            $table->string('file_name')->nullable();
            // $table->string('file_name')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_messages');
    }
};
