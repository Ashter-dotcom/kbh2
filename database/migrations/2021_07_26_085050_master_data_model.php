<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_model') )
        {
            Schema::create('master_data_model', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('apm_id');
                $table->string('jenis_kbm', 50);
                $table->string('nama_model', 50)->unique();
                $table->string('nama_tipe', 50);
                $table->string('nama_varian', 50);
                $table->integer('nama_kapasitas_silinder');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('nama_model', 'master_data_model_nama_model_index');
                $table->index('created_at', 'master_data_model_created_at_index');
                $table->index('updated_at', 'master_data_model_updated_at_index');
                $table->engine = 'InnoDB';

                $table->foreign('apm_id')
                    ->references('id')->on('master_data_apm')
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
        Schema::dropIfExists('master_data_model');
    }
}
