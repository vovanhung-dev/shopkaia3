<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToTopUpOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('top_up_orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status');
            $table->timestamp('paid_at')->nullable()->after('payment_method');
        });
    }

    public function down()
    {
        Schema::table('top_up_orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'paid_at']);
        });
    }
} 