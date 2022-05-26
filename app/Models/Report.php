<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public static function getDataReports(){
        $reports = Report::all();
        $reports_filter = [];
        $no = 1;

        for($i=0; $i<$reports->count();$i++){
            $reports_filter[$i]['no'] = $no++;
            $reports_filter[$i]['title'] = $reports[$i]->title;
            $reports_filter[$i]['file'] = $reports[$i]->file;
            $reports_filter[$i]['date_submission'] = $reports[$i]->date_submission;
            $reports_filter[$i]['date_accepted'] = $reports[$i]->date_accepted;
        }
        return $reports_filter;
    }
}
