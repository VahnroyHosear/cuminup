<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocsAndPackageFeeMerchantGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_groups', function (Blueprint $table) {
            $table->double('package_fee',8,2);
            $table->longText('documents',8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_groups', function (Blueprint $table) {
            $table->dropColumn(['package_fee', 'documents']);
        });
    }
}
