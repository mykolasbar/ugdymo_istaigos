<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_schools', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('hotels_id')->nullable;
            // $table->unsignedBigInteger('user_id')->nullable;
            $table->timestamps();
            // $table->foreign('hotels_id')->references('id')->on('Hotels')->onDelete('cascade')->onUpdate('restrict');
            // $table->foreign('user_id')->references('id')->on('User')->onDelete('cascade')->onUpdate('restrict');
            $table->foreignId('requests_id')->constrained('requests')->onDelete('cascade')->onUpdate('restrict')->nullable;
            $table->foreignId('schools_id')->constrained('schools')->onDelete('cascade')->onUpdate('restrict')->nullable;
            $table->boolean('confirmed');
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
};
