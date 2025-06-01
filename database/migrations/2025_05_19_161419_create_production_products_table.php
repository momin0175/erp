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
       Schema::create('production_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(); // foreign key হিসেবে থাকবে
            $table->string('thikness')->nullable();
            $table->string('gsm')->nullable();
            $table->string('weight')->nullable();
            $table->string('dia')->nullable();
            $table->string('size')->nullable();
            $table->string('proter_sort')->nullable();
            $table->string('qty')->nullable();
            $table->date('production_date')->nullable();
            $table->string('shift')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('product_id')->references('id')->on('product_services')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_products');
    }
};
