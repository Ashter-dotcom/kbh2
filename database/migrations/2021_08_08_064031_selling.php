<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Selling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('production_selling') )
        {
            Schema::create('production_selling', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->char('nik', 18)->unique();
                $table->date('tanggal_produksi');
                $table->date('tanggal_penjualan')->nullable();
                $table->char('penjualan', 10)->nullable();
                $table->integer('harga')->nullable();
                $table->uuid('model_id');
                $table->char('konsumen', 255)->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('nik', 'production_selling_nik_index');
                $table->index('model_id', 'production_selling_model_id_index');
                $table->index('tanggal_produksi', 'production_selling_tanggal_produksi_index');
                $table->index('tanggal_penjualan', 'production_selling_tanggal_penjualan_index');
                $table->index('created_at', 'production_selling_created_at_index');
                $table->index('updated_at', 'production_selling_updated_at_index');
                $table->engine = 'InnoDB';


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
        Schema::dropIfExists('production_selling');
    }
}
