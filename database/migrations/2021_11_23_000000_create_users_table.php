<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('md5password');
            $table->string('password');
            $table->integer('active');
            $table->unsignedBigInteger('status')->nullable();
            $table->unsignedBigInteger('unit')->nullable();
            $table->unsignedBigInteger('department')->nullable();
            $table->foreign('status')
                ->nullable()
                ->references('id')
                ->on('user_statuses')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('unit')
                ->nullable()
                ->references('id')
                ->on('units')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('department')
                ->nullable()
                ->references('id')
                ->on('departments')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
