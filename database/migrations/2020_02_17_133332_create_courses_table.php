<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academic', 10);
            $table->unsignedTinyInteger('semester');
            $table->string('code', 10)->unique();
            $table->string('name', 100)->unique();
            $table->text('description');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('taught_by')->nullable();
            $table->softDeletes()->nullable();
            $table->timestamps();

            $table->foreign('department_id')->on('departments')
                ->references('id')->onDelete('cascade');
            $table->foreign('taught_by')->on('users')
                ->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
