<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Production extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('production_supplier') )
        {
            Schema::create('production_supplier', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('komponen_supplier_id');
                $table->uuid('model_id');
                $table->uuid('tahun', 4)->default('2021');
                $table->uuid('stock', 10)->nullable();
                $table->longText('produksi')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('komponen_supplier_id', 'production_supplier_komponen_supplier_id_index');
                $table->index('model_id', 'production_supplier_model_id_index');
                $table->index('created_at', 'production_supplier_created_at_index');
                $table->index('updated_at', 'production_supplier_updated_at_index');
                $table->engine = 'InnoDB';

                $table->foreign('komponen_supplier_id')->references('id')->on('component_suppliers')->onDelete('cascade');
                $table->foreign('model_id')->references('id')->on('master_data_model')->onDelete('cascade');
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
        Schema::dropIfExists('production_supplier');
    }
}
