<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained();
            $table->string('title',50);
            $table->string('file');
            $table->string('status')->default("Belum Disetujui");
            $table->boolean('validated_bem')->default(false);
            $table->boolean('validated_blm')->default(false);
            $table->boolean('validated_pembimbing')->default(false);
            $table->boolean('validated_wd3')->default(false);
            $table->boolean('validated_dekan')->default(false);
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
        Schema::dropIfExists('proposals');
    }
}
