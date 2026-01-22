<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->string('member1_name');
            $table->string('member1_gender');
            $table->string('member2_name');
            $table->string('member2_gender');
            $table->string('calculation_type');
            $table->integer('percentage');
            $table->text('description')->nullable();
            $table->json('compatibility_points')->nullable();
            $table->json('improvement_tips')->nullable();
            $table->string('unique_id')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
