<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewD7 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::statement("
        
            CREATE VIEW data_d7 
            AS
            SELECT
                ps.harga, 
                ps.konsumen as customer, 
                ps.nik, 
                ps.tanggal_produksi,
                ps.tanggal_penjualan, 
                mda.id as apm_id,
                mda.nama_perusahaan_apm, 
                mdm.id as model_id, 
                mdm.jenis_kbm, 
                mdm.nama_model, 
                mdm.nama_tipe, 
                mdm.nama_varian,
                mdm.nama_kapasitas_silinder,
                md_merek.merek
            FROM 
                production_selling as ps 
                JOIN master_data_model as mdm ON ps.model_id = mdm.id 
                JOIN master_data_apm as mda ON mdm.apm_id = mda.id
                JOIN master_data_merek as md_merek ON mda.id = md_merek.apm_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
