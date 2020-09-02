<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            
             $table->string('image');
              $table->string('sub_title')->nullable();
              $table->string('sub_title_color')->nullable();
             $table->string('title')->nullable();
             $table->string('title_color')->nullable();
             $table->longText('text')->nullable();
             $table->longText('text_color')->nullable();
             $table->string('link')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
