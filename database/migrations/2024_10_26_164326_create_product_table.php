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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('description');
            $table->timestamps();
        });
    }

    /**
     * CRUD-System----Laravel
     * connect Laravel application with database to create, update and delete data.
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
