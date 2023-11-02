<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Suppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('component_suppliers') )
        {
            Schema::create('component_suppliers', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->boolean('in_house')->default(0);
                $table->string('actual_component_name', 100);
                $table->char('supplier_id', 36)->nullable();
                $table->char('sub_supplier_id', 36)->nullable();
                $table->char('component_id', 36);
                $table->char('model_id', 36);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->softDeletes()->index();
                $table->index('supplier_id', 'component_suppliers_supplier_id_index');
                $table->index('sub_supplier_id', 'component_suppliers_sub_supplier_id_index');
                $table->index('component_id', 'component_suppliers_component_id_index');
                $table->index('model_id', 'component_suppliers_model_id_index');
                $table->index('created_at', 'component_suppliers_created_at_index');
                $table->index('updated_at', 'component_suppliers_updated_at_index');
                $table->engine = 'InnoDB';


                $table->foreign('model_id')->references('id')->on('master_data_model')->onDelete('cascade');
                $table->foreign('supplier_id')->references('id')->on('master_data_supplier')->onDelete('cascade');
                $table->foreign('sub_supplier_id')->references('id')->on('master_data_supplier')->onDelete('cascade');
                $table->foreign('component_id')->references('id')->on('master_data_komponen')->onDelete('cascade');
                
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
        Schema::dropIfExists('component_suppliers');
    }
}
