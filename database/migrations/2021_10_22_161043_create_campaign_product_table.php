<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_product', function (Blueprint $table) {
          $table->bigInteger('campaign_id')->unsigned();
          $table->bigInteger('product_id')->unsigned();
          $table->float('discount', 4,2, true)->default(0);

          $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('CASCADE')->onUpdate('CASCADE');
          $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('campaign_product');
    }
}
