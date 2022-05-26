<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function landing(){
        $activities = Activity::all();
        return view('welcome',compact('activities'));
    }
}
