<?php

use App\Models\Merchant;
use App\Models\MerchantPackages;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('merchant_group_id');
            $table->enum('status', ['Moderation', 'Disapproved', 'Approved','OldApproved'])->default('Moderation');
            $table->timestamps();
            $table->softDeletes();
        });

        /*$MerchantGroup = Merchant::where('is_default','Yes')->first();

        User::where('type','merchant')->get()->each(function ($item) use ($MerchantGroup){
            MerchantPackages::create([
                'user_id' => $item->id,
                'merchant_group_id' => $MerchantGroup->id,
                'status' => 'Approved'
            ]);
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_packages');
    }
}
