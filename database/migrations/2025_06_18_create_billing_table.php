<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingInformationTable extends Migration
{
    public function up()
    {
        Schema::connection('admin')->create('billing_info', function (Blueprint $table) {
            $table->id();
            $table->dateTime('bill_date')->useCurrent();
            $table->decimal('bill_total_amount', 10, 2);
            $table->string('customer_name');
            $table->string('customer_email')->unique();
            $table->string('customer_phone_no')->unique();
            $table->string('customer_address')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('admin')->dropIfExists('billing_info');
    }
}