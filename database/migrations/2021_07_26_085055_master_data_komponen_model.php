<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterDataKomponenModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_komponen_model') )
        {
            Schema::create('master_data_komponen_model', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('komponen_id');
                $table->uuid('model_id');
                $table->boolean('menggunakan')->default(false);
                $table->integer('jumlah')->default(0);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('created_at', 'master_data_komponen_model_created_at_index');
                $table->index('updated_at', 'master_data_komponen_model_updated_at_index');
                $table->engine = 'InnoDB';

                $table->foreign('komponen_id')
                    ->references('id')->on('master_data_komponen')
                    ->onDelete('cascade');
                $table->foreign('model_id')
                    ->references('id')->on('master_data_model')
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
        Schema::dropIfExists('master_data_komponen_model');
    }
}
