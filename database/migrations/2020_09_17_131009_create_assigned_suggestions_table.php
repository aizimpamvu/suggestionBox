<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_suggestions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigned_user');
            $table->integer('suggestion_id');

            $table->longText('comment');
            $table->timestamps();

            $table->foreign('assigned_user')->references('id')->on('users');
            $table->foreign('suggestion_id')->references('id')->on('suggestions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigned_suggestions');
    }
}
