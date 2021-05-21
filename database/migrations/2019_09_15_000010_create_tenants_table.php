<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('password');
            $table->string('email');

            // your custom columns may go here
            $table->integer('number_of_branches')->default(0);
            $table->string('status')->default('pending');
            $table->double('subscription_price')->default(0);

            $table->integer('subscription_period_in_days')->default(0);
            $table->timestamp('subscription_date')->nullable();
            $table->timestamp('subscription_end_date')->nullable();

            $table->timestamp('created_at');
            $table->timestamps();

            $table->string('activation_token');
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
