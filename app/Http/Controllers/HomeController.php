<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Proposal;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $user = Auth::user();
        $proposal = Proposal::all()->count();
        $jumlahActivity = Activity::all()->where("users_id",$user->id)->count();
        $jumlahProposal = Proposal::all()->where("users_id",$user->id)->count();
        $jumlahProposalDiterima = Proposal::all()->where("users_id",$user->id)->where("validated_dekan" , 1)->count();
        $jumlahProposalMenungguPersetujuan = Proposal::all()->where("users_id",$user->id)->where("validated_dekan",0)->count();
        $menungguBem = Proposal::all()->where("validated_bem",0)->count();
        $disetujuiBem = Proposal::all()->where("validated_bem",1)->count();
        $menungguBlm = Proposal::all()->where("validated_blm",0)->where("validated_bem",1)->count();
        $disetujuiBlm = Proposal::all()->where("validated_blm",1)->count();
        $menungguPembimbing = Proposal::all()->where("validated_pembimbing",0)->where("validated_blm",1)->count();
        $disetujuiPembimbing = Proposal::all()->where("validated_pembimbing",1)->count();
        $menungguWd3 = Proposal::all()->where("validated_wd3",0)->where("validated_pembimbing",1)->count();
        $disetujuiWd3 = Proposal::all()->where("validated_wd3",1)->count();
        $menungguDekan = Proposal::all()->where("validated_dekan",0)->where("validated_wd3",1)->count();
        $disetujuiDekan = Proposal::all()->where("validated_dekan",1)->count();
        $jumlahUser = User::all()->count();
        return view('home',compact('user','proposal','jumlahActivity','jumlahProposal','jumlahProposalDiterima','jumlahProposalMenungguPersetujuan','jumlahUser','menungguBem','disetujuiBem','menungguBlm','disetujuiBlm','menungguPembimbing','disetujuiPembimbing','menungguWd3','disetujuiWd3','menungguDekan','disetujuiDekan'));
    }


}
