<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActualComponentNameCharacterLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('component_suppliers', function (Blueprint $table) {
			$table->string('actual_component_name',250)->change();
		});
	}
}
