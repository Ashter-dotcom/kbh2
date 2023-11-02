<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PicApm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_data_apm', function($table){
            $table->string('divisi_pic')->after('nama_pic');
            $table->string('email_pic')->after('divisi_pic');
            $table->string('no_telp_pic')->after('email_pic');
            $table->string('tanggal_kesediaan_diverifikasi')->nullable()->after('no_telp_pic');
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
