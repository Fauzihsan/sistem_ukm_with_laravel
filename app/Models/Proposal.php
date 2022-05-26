<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public static function getDataProposals(){
        $proposals = Proposal::all();
        $proposals_filter = [];
        $no = 1;

        for($i=0; $i<$proposals->count();$i++){
            $proposals_filter[$i]['no'] = $no++;
            $proposals_filter[$i]['title'] = $proposals[$i]->title;
            $proposals_filter[$i]['status'] = $proposals[$i]->status;
            $proposals_filter[$i]['users_id'] = $proposals[$i]->users_id;
            $proposals_filter[$i]['file'] = $proposals[$i]->file;
            $proposals_filter[$i]['created_at'] = $proposals[$i]->created_at;
        }
        return $proposals_filter;
    }

}
