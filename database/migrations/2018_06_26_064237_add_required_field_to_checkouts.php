<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequiredFieldToCheckouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function(Blueprint $table) {
            $table->string('name');
            $table->string('company_name');
            $table->string('email_address');
            $table->string('mobile_number');
            $table->text('address');
            $table->string('city');
            $table->string('zip_code');
            $table->string('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
