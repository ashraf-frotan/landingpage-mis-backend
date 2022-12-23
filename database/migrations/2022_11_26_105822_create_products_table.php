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
            $table->string('title_ar',255)->nullable();
            $table->string('title_en',255)->nullable();
            $table->text('desc_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('message_ar')->nullable();
            $table->text('message_en')->nullable();
            $table->string('page_link',255);
            $table->tinyInteger('page_status')->nullable()->default(0)->comment('[0=>registerd, 1=>published, 2=>unpublished]');
            $table->tinyInteger('page_language')->default(1)->comment('[0=>both, 1=>arabic, 2=>english]');
            $table->boolean('is_collection')->default(0);
            $table->boolean('sale_type')->default(0)->comment('[0=>simple, 1=>1+1 free]');
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
