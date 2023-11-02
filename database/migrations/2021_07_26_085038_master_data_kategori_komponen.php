<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataKategoriKomponen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_kategori_komponen') )
        {
            Schema::create('master_data_kategori_komponen', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('nama_kategori_komponen', 50)->unique();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('created_at', 'master_data_kategori_komponen_created_at_index');
                $table->index('updated_at', 'master_data_kategori_komponen_updated_at_index');
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
        Schema::dropIfExists('master_data_kategori_komponen');
    }
}
