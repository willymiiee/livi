<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('identifier', 50);
            $table->string('title');
            $table->string('category');
            $table->string('creator');
            $table->text('description')->nullable();
            $table->string('language', 10);
            $table->char('year', 4);
            $table->string('publisher_id');
            $table->string('currency');
            $table->float('price')->default(0);
            $table->float('reseller_share')->default(0);
            $table->string('format')->nullable();
            $table->string('encryption')->nullable();
            $table->string('whitelabel')->nullable();
            $table->string('position')->nullable();
            $table->string('type')->nullable();
            $table->text('cover')->nullable();
            $table->text('epub')->nullable();
            $table->text('epub_sample')->nullable();
            $table->enum('featured', ['N','Y']);
            $table->enum('best_seller', ['N','Y']);
            $table->enum('new', ['N','Y']);
            $table->enum('active', ['Y','N']);
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
        Schema::drop('books');
    }
}
