<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->string('sad_id')->nullable();
            $table->string('customs_office_code')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->string('manifest_number')->nullable();
            $table->string('awb_number')->nullable();
            $table->string('lp_ref')->nullable();
            $table->string('qty')->nullable();
            $table->string('weight')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('releases');
    }
}
