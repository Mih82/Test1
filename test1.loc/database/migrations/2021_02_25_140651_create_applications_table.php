<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apllications', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('topic', 255);
			$table->text('text');
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('path')->default(0);
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
        Schema::dropIfExists('Apllications');
    }
}
