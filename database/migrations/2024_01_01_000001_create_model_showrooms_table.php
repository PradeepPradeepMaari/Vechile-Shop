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
        Schema::create('model_showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('model_name', 60);
            $table->integer('year');
            $table->decimal('price', 10, 2);
            $table->string('image', 255)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_showrooms');
    }
};

