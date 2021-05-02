<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaoranbarangkeluarTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER addlaporankeluar AFTER INSERT ON transactions FOR EACH ROW UPDATE products SET qty= qty-new.qty WHERE id = new.products_id');
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
