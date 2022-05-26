<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProposalacceptedTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Illuminate\Support\Facades\DB::unprepared(
            'CREATE TRIGGER proposals_accepted AFTER UPDATE ON proposals
            FOR EACH ROW
            BEGIN
                IF (NEW.validated_dekan != 0) THEN
                    INSERT INTO reports(title,proposal,date_submission,date_accepted) VALUES (OLD.title,OLD.file,OLD.created_at, now());
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
