<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataSupplierApm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_supplier_pic') )
        {
            Schema::create('master_data_supplier_pic', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('apm_id');
                $table->uuid('supplier_id');
                $table->string('nama_pic', 50);
                $table->string('divisi_pic', 50)->nullable();
                $table->string('email_pic', 50)->nullable();
                $table->string('no_telp_pic', 50)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('nama_pic', 'master_data_supplier_pic_nama_pic_index');
                $table->index('created_at', 'master_data_supplier_pic_created_at_index');
                $table->index('updated_at', 'master_data_supplier_pic_updated_at_index');
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
        Schema::dropIfExists('master_data_supplier_pic');
    }
}
