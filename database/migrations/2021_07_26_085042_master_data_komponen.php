<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataKomponen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_komponen') )
        {
            Schema::create('master_data_komponen', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('kategori_id');
                $table->string('nama_komponen', 50);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('kategori_id', 'master_data_komponen_kategori_id_index');
                $table->index('created_at', 'master_data_komponen_created_at_index');
                $table->index('updated_at', 'master_data_komponen_updated_at_index');
                $table->engine = 'InnoDB';

                $table->foreign('kategori_id')
                    ->references('id')->on('master_data_kategori_komponen')
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
        Schema::dropIfExists('master_data_komponen');
    }
}
