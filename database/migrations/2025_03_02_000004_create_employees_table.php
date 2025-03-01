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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employee_id', 11)->primary();
            $table->string('name', 50);
            $table->string('birth_place', 50);
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->string('phone_number', 15)->nullable();
            $table->string('npwp_number', 20)->nullable();
            
            $table->unsignedInteger('religion_id');
            $table->unsignedInteger('work_unit_id')->nullable();
            $table->unsignedInteger('rank_id')->nullable();
            $table->unsignedInteger('echelon_id')->nullable();
            $table->unsignedInteger('work_place_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            
            $table->timestamps();

            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('restrict');
            $table->foreign('work_unit_id')->references('id')->on('work_units')->onDelete('set null');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('set null');
            $table->foreign('echelon_id')->references('id')->on('echelons')->onDelete('set null');
            $table->foreign('work_place_id')->references('id')->on('work_places')->onDelete('set null');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
