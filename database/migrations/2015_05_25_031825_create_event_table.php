<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id');
            $table->string('name');
            $table->string('slug');
            $table->timestamp("start_time");
            $table->timestamp("end_time");
            $table->integer("credits");
            $table->longText("description");
            $table->boolean("screening_required");
            $table->integer("age_requirement");
            $table->string("category");
            $table->string("phone");
            $table->string("email");
            $table->string("state");
            $table->string("city");
            $table->string("address");
            $table->string("zipcode");
            $table->integer("max_users");
            $table->integer("status");
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
        Schema::drop('event');
    }
}
