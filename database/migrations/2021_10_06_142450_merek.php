<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Merek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('master_data_merek') )
        {
            Schema::create('master_data_merek', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('apm_id');
                $table->string('merek', 50);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('created_at', 'master_data_merek_created_at_index');
                $table->index('updated_at', 'master_data_merek_updated_at_index');
                $table->engine = 'InnoDB';

                $table->foreign('apm_id')
                    ->references('id')->on('master_data_apm')
                    ->onDelete('cascade');
            });
        }

        if (Schema::hasTable('master_data_model')) {
            Schema::table('master_data_model', function($table){
                $table->uuid('merek_id')->nullable()->after('apm_id');
            });
            Schema::table('master_data_model', function($table){
                $table->uuid('merek_id')->unsigned()->index()->nullable()->change();

                $table->foreign('merek_id')->references('id')->on('master_data_merek');
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
        //
    }
}
