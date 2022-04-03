<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('article_number');
            $table->string('article_name');
            $table->string('manufacturer');
            $table->text('description');
            $table->text('article_information');
            $table->string('gender');
            $table->string('product_type');
            $table->string('sleeves');
            $table->string('legs');
            $table->string('collar');
            $table->string('manufacture');
            $table->string('bag_type');
            $table->string('grammage');
            $table->string('material');
            $table->string('country_of_origin');
            $table->string('image_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
