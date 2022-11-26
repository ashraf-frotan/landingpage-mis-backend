<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('pcode',8);
            $table->string('title_ar',255);
            $table->string('title_en',255);
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->text('message_ar');
            $table->text('message_en');
            $table->string('page_link',255);
            $table->tinyInteger('page_status')->default(0)->comment('[0=>registerd, 1=>published, 2=>unpublished]');
            $table->tinyInteger('page_language')->default(1)->comment('[0=>both, 1=>arabic, 2=>english]');
            $table->boolean('is_collection')->default(0);
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id')->references('id')->on('templates');
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
}
