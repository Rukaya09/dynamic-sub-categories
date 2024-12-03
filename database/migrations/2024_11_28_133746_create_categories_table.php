<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('icon', 250)->nullable();
            $table->string('icon_storage_type', 10)->default('public');
            $table->integer('position')->default(0);
            $table->boolean('home_status')->default(0);
            $table->integer('priority')->nullable();
            $table->integer('parent_id')->nullable()->default(0);
            $table->timestamps();

            // Foreign key to self-reference
        });
    }
                        
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
