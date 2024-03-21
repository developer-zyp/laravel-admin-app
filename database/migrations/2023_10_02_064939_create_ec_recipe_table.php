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
        Schema::create('ec_recipe', function (Blueprint $table) {
            $table->id();
            $table->integer('categoryid')->default(0);
            $table->integer('postid')->default(0);
            $table->string('name',500);
            $table->string('imageurl',500)->nullable();
            $table->text('method')->nullable();
            $table->integer('seen')->default(0);
            $table->integer('fav')->default(0);
            $table->tinyInteger('isdelete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_recipe');
    }
};
