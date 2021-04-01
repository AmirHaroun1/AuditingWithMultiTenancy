<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_registers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number')->unique(); //الرقم
            $table->date('date'); //تاريخ الصدور
            $table->string('production_place'); //مكان الصدور
            $table->string('type'); //فرعي / رئيسي
            $table->date('EndDate'); // تاريخ الانتهاء
            $table->foreignId('institution_id')->nullable();  // الشركة
            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions')
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
        Schema::dropIfExists('trade_registers');
    }
}
