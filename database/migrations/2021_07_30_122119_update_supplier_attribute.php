<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSupplierAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_data_supplier', function($table) {
            $table->dropColumn('no_telp_kantor');
            $table->dropColumn('nama_pic');
            $table->dropColumn('divisi_pic');
            $table->dropColumn('email_pic');
            $table->date('tanggal_kesediaan_diverifikasi')->change();
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
