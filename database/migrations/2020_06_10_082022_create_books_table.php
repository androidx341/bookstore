<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->integer('pagesCount')->unsigned();
            $table->text('annotation');
            $table->string('coverImage', '255');
            $table->bigInteger('createBy')->unsigned();
            $table->bigInteger('authorId')->unsigned();
            $table->timestamps();

            $table->foreign('authorId')->references('id')->on('authors');
            $table->foreign('createBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
