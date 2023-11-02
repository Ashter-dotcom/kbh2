<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTingkatUtilitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('profil_perusahaan_supplier')) {
            Schema::table('profil_perusahaan_supplier', function (Blueprint $table) {
                $table->decimal('tingkat_utilitas', 26, 4)->default(0)->change();
            });
        }

        if (Schema::hasTable('profil_perusahaan_apm')) {
            Schema::table('profil_perusahaan_apm', function (Blueprint $table) {
                $table->decimal('tingkat_utilitas', 26, 4)->default(0)->change();
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
