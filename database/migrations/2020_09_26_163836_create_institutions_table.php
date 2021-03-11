<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); //الأسم
            $table->unsignedBigInteger('number')->unique(); //رقم الشركة
            $table->text('address')->nullable(); // عنوان الشركة
            $table->text('business_activity')->nullable(); //نشاط المنشأة
            $table->string('legal_entity')->nullable(); //الكيان القانوني
            $table->string('angel_interests')->nullable(); //اهتمامات الملاك
            $table->string('nature')->nullable(); //طبيعة ملكية المنشأة وكيفية تمويلها
            $table->string('date_type')->nullable();
            $table->unsignedBigInteger('charity_num')->nullable(); //الرقم المميز لدى هيئة الذكاة
            $table->unsignedBigInteger('extra_tax_num')->nullable(); // رقم الضريبة المضافة

            $table->decimal('latitudes',10,8)->nullable();
            $table->decimal('longitudes',11,8)->nullable();

            $table->foreignId('agent_id')->nullable();  // المسؤول عن التعاقد
            $table->foreign('agent_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
}
