<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Activity extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User', 'users_id');
    }

    public static function getDataActivities(){
        $activities = Activity::all();
        $activities_filter = [];
        $no = 1;

        for($i=0; $i<$activities->count();$i++){
            $activities_filter[$i]['no'] = $no++;
            $activities_filter[$i]['title'] = $activities[$i]->title;
            $activities_filter[$i]['description'] = $activities[$i]->description;
            $activities_filter[$i]['users_id'] = $activities[$i]->users_id;
            $activities_filter[$i]['poster'] = $activities[$i]->poster;
            $activities_filter[$i]['created_at'] = $activities[$i]->created_at;
        }
        return $activities_filter;
    }

}
