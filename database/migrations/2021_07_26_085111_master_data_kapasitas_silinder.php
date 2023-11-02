<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataKapasitasSilinder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_kapasitas_silinder') )
        {
            Schema::create('master_data_kapasitas_silinder', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('nama_kelompok', 50)->unique();
                $table->integer('minimal');
                $table->integer('maksimal');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('nama_kelompok', 'master_data_kapasitas_silinder_nama_kelompok_index');
                $table->index('created_at', 'master_data_kapasitas_silinder_created_at_index');
                $table->index('updated_at', 'master_data_kapasitas_silinder_updated_at_index');
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
        Schema::dropIfExists('master_data_kapasitas_silinder');
    }
}
