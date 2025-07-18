<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_id');
            $table->string('name');
            $table->string('relation');
            $table->enum('gender', ['L', 'P']);
            $table->date('birth_date')->nullable();
            $table->timestamps();

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
