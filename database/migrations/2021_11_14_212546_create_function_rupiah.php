<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionRupiah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fungsi_rupiah = '
            CREATE FUNCTION `fRupiah` (number BIGINT) 
            RETURNS VARCHAR(255) CHARSET latin1 DETERMINISTIC  
            RETURN REPLACE(REPLACE(REPLACE(FORMAT(number, 0), ".", "|"), ",", "."), "|", ",")
        ';
  
        \DB::unprepared($fungsi_rupiah);
    }

    public function down()
    {
        
    }
}
