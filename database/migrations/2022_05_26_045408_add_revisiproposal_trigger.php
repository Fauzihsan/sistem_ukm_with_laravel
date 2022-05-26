<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRevisiproposalTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Illuminate\Support\Facades\DB::unprepared(
            'CREATE TRIGGER proposals_revisi AFTER UPDATE ON proposals
            FOR EACH ROW
            BEGIN
                IF (NEW.file != OLD.file) THEN
                    DELETE FROM comments WHERE proposals_id = new.id;
                END IF;
            END;'
        );
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
