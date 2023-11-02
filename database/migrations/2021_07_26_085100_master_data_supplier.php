<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_supplier') )
        {
            Schema::create('master_data_supplier', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('nama_perusahaan_supplier', 255)->unique();
                $table->string('no_telp_kantor', 50);
                $table->string('nama_pic', 50);
                $table->string('divisi_pic', 50);
                $table->string('email_pic', 50);
                $table->timestamp('tanggal_kesediaan_diverifikasi')->nullable();
                $table->text('alamat_pabrik')->nullable();
                $table->string('keterangan')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('nama_perusahaan_supplier', 'master_data_supplier_nama_perusahaan_supplier_index');
                $table->index('created_at', 'master_data_supplier_created_at_index');
                $table->index('updated_at', 'master_data_supplier_updated_at_index');
                $table->engine = 'InnoDB';
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
        Schema::dropIfExists('master_data_supplier');
    }
}
