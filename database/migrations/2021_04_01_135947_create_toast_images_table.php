<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToastImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toast_images', function (Blueprint $table) {
            $table->id();
            $table->string("imagename");
            $table->foreignId("toast_id")->constrained('toasts', 'id')->onDelete("cascade");
            $table->foreignId("user_id")->constrained('users', 'id')->onDelete("cascade");
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
        Schema::dropIfExists('toast_images');
    }
}
