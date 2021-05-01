<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaporanbarangmasukTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER addlaporanfrominsert AFTER INSERT ON products FOR EACH ROW INSERT INTO laporanBarangMasuks SET name = new.name, qty= new.qty, created_at = new.created_at , users_id=new.users_id');
        Illuminate\Support\Facades\DB::unprepared('CREATE TRIGGER addlaporanfromupdate AFTER UPDATE ON products FOR EACH ROW INSERT INTO laporanBarangMasuks SET name = new.name, qty= new.qty, created_at = new.updated_at, users_id=new.users_id');
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
