<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PageSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_section', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->String('image_path');
            $table->longText('description');
            $table->string('section');
            $table->unsignedBigInteger('page_id');
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('cms_pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
