<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url');
            $table->string('method');
            $table->jsonb('ips');
            $table->jsonb('input');
            $table->jsonb('server');
            $table->jsonb('headers');
            $table->jsonb('cookies');
            $table->jsonb('user');
            $table->jsonb('exception');
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
        Schema::dropIfExists('errors');
    }
}
