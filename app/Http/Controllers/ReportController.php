<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportController extends Controller
{
    public function reports(){
        $user = Auth::user();
        $reports = Report::orderBy('date_accepted','DESC')->get();
        return view('report_proposal_accepted', compact('user','reports'));
    }

    public function print_report_proposal(){
        $reports = Report::all();

        $pdf = PDF::loadview('print_report_proposal_accepted', ['reports' => $reports]);
        return $pdf->download('report_periode'.now().'.pdf');
    }
}
