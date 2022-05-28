<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use PDF;
use File;
use ZipArchive;

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
    public function print_all_proposal(){

        $zip = new ZipArchive;

        $fileName = now()->toDateString().'_proposal_diterima.zip';

        if($zip->open(public_path($fileName), ZipArchive::CREATE));

            $files = File::files(public_path('/storage/acc_proposal/'));

            foreach ($files as $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();


            return response()->download(public_path($fileName));
    }
}
