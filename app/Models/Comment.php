<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public function proposal(){
        return $this->belongsTo('App\Models\Proposal', 'proposals_id');
    }

    public static function getDataFeedback(){
        $feedbacks = Comment::all();
        $feedbacks_filter = [];
        $no = 1;

        for($i=0; $i<$feedbacks->count();$i++){
            $feedbacks_filter[$i]['no'] = $no++;
            $feedbacks_filter[$i]['proposals_id'] = $feedbacks[$i]->proposals_id;
            $feedbacks_filter[$i]['comment'] = $feedbacks[$i]->comment;
            $feedbacks_filter[$i]['comment_by'] = $feedbacks[$i]->comment_by;
        }
        return $feedbacks_filter;
    }
}
