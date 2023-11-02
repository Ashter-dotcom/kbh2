<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataPeriode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_periode') )
        {
            Schema::create('master_data_periode', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('nama_periode', 50)->unique();
                $table->timestamp('mulai')->nullable();
                $table->timestamp('selesai')->nullable();
                $table->text('kelompok_kapasitas_silinder');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('nama_periode', 'master_data_periode_nama_periode_index');
                $table->index('created_at', 'master_data_periode_created_at_index');
                $table->index('updated_at', 'master_data_periode_updated_at_index');
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
        Schema::dropIfExists('master_data_periode');
    }
}
