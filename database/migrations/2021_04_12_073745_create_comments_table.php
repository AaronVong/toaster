<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('user_id')->constrained("users", 'id')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable(true)->constrained('comments', 'id')->onDelete('cascade');
            $table->text('comment');
            $table->foreignId('commentable_id')->constrained('toasts', 'id')->onDelete('cascade');
            $table->string('commentable_type');
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
        Schema::dropIfExists('comments');
    }
}
