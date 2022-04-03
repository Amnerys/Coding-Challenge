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
            //All the other fields are nullable because the CSV file contains all these blank fields
            //We could make a condition in the import to not take articles that don't have 'article_number', for example
            $table->text('article_number')->nullable();
            $table->text('article_name')->nullable();
            $table->text('manufacturer')->nullable();
            $table->text('description')->nullable();
            $table->text('article_information')->nullable();
            $table->text('gender')->nullable();
            $table->text('product_type')->nullable();
            $table->text('sleeves')->nullable();
            $table->text('legs')->nullable();
            $table->text('collar')->nullable();
            $table->text('manufacture')->nullable();
            $table->text('bag_type')->nullable();
            $table->text('grammage')->nullable();
            $table->text('material')->nullable();
            $table->text('country_of_origin')->nullable();
            $table->string('image_name')->nullable();
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
