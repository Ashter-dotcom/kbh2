<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataApm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_apm') )
        {
            Schema::create('master_data_apm', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('slug', 50)->unique();
                $table->string('nama_perusahaan_apm', 255);
                $table->string('nama_pic', 50);
                $table->string('npwp_perusahaan', 20);
                $table->string('no_telp_kantor', 15)->nullable();
                $table->text('alamat_kantor')->nullable();
                $table->text('alamat_pabrik')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('slug', 'master_data_apm_slug_index');
                $table->index('created_at', 'master_data_apm_created_at_index');
                $table->index('updated_at', 'master_data_apm_updated_at_index');
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
        Schema::dropIfExists('master_data_apm');
    }
}
