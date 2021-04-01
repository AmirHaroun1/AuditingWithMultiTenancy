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
            $table->string('number700')->nullable();
            $table->string('number300')->nullable();
            $table->text('business_activity')->nullable(); //نشاط المنشأة
            $table->text('address')->nullable(); // عنوان الشركة
            $table->string('type')->nullable(); // to determine if organization or company
            $table->string('postal_box')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('fax')->nullable();
            $table->double('capital')->nullable();
            $table->string('phone');

            $table->string('angel_interests')->nullable(); //اهتمامات الملاك
            $table->string('date_type')->nullable();
            $table->unsignedBigInteger('charity_num')->nullable(); //الرقم المميز لدى هيئة الذكاة
            $table->unsignedBigInteger('extra_tax_num')->nullable(); // رقم الضريبة المضافة
            $table->json('managers')->nullable();
            //in case of organization
            $table->string('merchant_name')->nullable();
            $table->date('merchant_birth_date')->nullable();
            $table->string('merchant_nationality')->nullable();
            $table->text('manager_authorities')->nullable();
            // in case of company
            $table->string('legal_entity')->nullable(); //الكيان القانوني
            $table->string('company_nationality')->nullable(); //جنسيتها
            $table->string('company_period')->nullable(); //مدة الشركة
            $table->date('company_start_period')->nullable(); //تبدأ من
            $table->date('company_end_period')->nullable(); //وتنتهي في

            // $table->decimal('latitudes',10,8)->nullable();
            // $table->decimal('longitudes',11,8)->nullable();

            $table->string('nature')->nullable(); //طبيعة ملكية المنشأة وكيفية تمويلها
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
