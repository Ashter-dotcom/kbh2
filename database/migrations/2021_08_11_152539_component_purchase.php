<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ComponentPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('component_purchase') )
        {
            Schema::create('component_purchase', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('model_id');
                $table->uuid('periode_id');
                $table->uuid('komponen_kategori_id');
                $table->longText('kebutuhan');
                $table->longText('pembelian');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('model_id', 'component_purchase_model_id_index');
                $table->index('periode_id', 'component_purchase_periode_id_index');
                $table->index('komponen_kategori_id', 'component_purchase_komponen_kategori_id_index');
                $table->index('created_at', 'component_purchase_created_at_index');
                $table->index('updated_at', 'component_purchase_updated_at_index');
                $table->engine = 'InnoDB';


                $table->foreign('model_id')->references('id')->on('master_data_model')->onDelete('cascade');
                $table->foreign('periode_id')->references('id')->on('master_data_periode')->onDelete('cascade');
                $table->foreign('komponen_kategori_id')->references('id')->on('master_data_kategori_komponen')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_purchase');
    }
}
