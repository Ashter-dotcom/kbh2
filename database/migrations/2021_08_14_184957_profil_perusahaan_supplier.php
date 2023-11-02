<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfilPerusahaanSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('profil_perusahaan_supplier') )
        {
            Schema::create('profil_perusahaan_supplier', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('supplier_id');
                $table->integer('bulan')->default(3);
                $table->integer('tahun')->default(2021);
                $table->string('kondisi', 7)->default('sebelum');
                $table->float('jumlah_produksi', 22, 2)->default(0);
                $table->float('jumlah_penjualan_ekspor', 22, 2)->default(0);
                $table->float('jumlah_penjualan_domestik', 22, 2)->default(0);
                $table->float('jumlah_tenaga_kerja', 22, 2)->default(0);
                $table->float('pph_21', 22, 2)->default(0);
                $table->float('pph_25', 22, 2)->default(0);
                $table->float('kapasitas_produksi', 22, 2)->default(0);
                $table->float('tingkat_utilitas', 22, 2)->default(0);
                $table->float('investasi_baru', 22, 2)->default(0);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('supplier_id', 'profil_perusahaan_supplier_supplier_id_index');
                $table->index('bulan', 'profil_perusahaan_supplier_bulan_index');
                $table->index('tahun', 'profil_perusahaan_supplier_tahun_index');
                $table->index('kondisi', 'profil_perusahaan_supplier_kondisi_index');
                $table->index('created_at', 'profil_perusahaan_supplier_created_at_index');
                $table->index('updated_at', 'profil_perusahaan_supplier_updated_at_index');
                $table->engine = 'InnoDB';

                $table->foreign('supplier_id')
                    ->references('id')->on('master_data_supplier')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('profil_perusahaan_supplier');
    }
}
