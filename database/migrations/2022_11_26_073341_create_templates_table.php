<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name',64);
            $table->string('phone',16);
            $table->string('email',64)->unique();
            $table->string('image',64);
            $table->string('directory',64);
            $table->unsignedBigInteger('company_id');
            $table->integer('type')->default(0)->comment('[0=>Long, 1=> Short, 2=>Whatsapp]');
            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('templates');
    }
}
