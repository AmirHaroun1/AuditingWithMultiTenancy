<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewGuidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revising_guid', function (Blueprint $table) {
            $table->id();

            $table->string('code')->nullable();
            $table->string('code_alias')->nullable();

            $table->text('name')->nullable();
            $table->string('name_alias')->nullable();

            $table->string('default_status')->nullable()->default(1);
            $table->string('default_reference')->nullable();

            $table->text('first_note')->nullable();
            $table->text('second_note')->nullable();

            $table->boolean('isText')->nullable();

            $table->integer('mark')->default(100);
            $table->boolean('AddedByUser')->default(0);

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('review_guides')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('revising_guid');
    }
}
