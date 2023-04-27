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
        Schema::create('temple_posts', function (Blueprint $table) {
            $table->id();
                     $table->string('title');
            $table->string('description');
            $table->string('location');
            $table->string('location_LatLng')->nullable();
            $table->string('time_table')->nullable();

           $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // $table->unsignedBigInteger('meta_id');
            // // $table->foreignId('meta_id')->constrained()->onDelete('cascade');
            // // $table->foreignId('meta_id')->constrained()->onDelete('cascade');
            // $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
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
        Schema::dropIfExists('temple_posts');
    }
};
