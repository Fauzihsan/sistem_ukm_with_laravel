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
        $jumlahActivity = Activity::all()->where("users_id",$user->id)->count();
        $jumlahProposal = Proposal::all()->where("users_id",$user->id)->count();
        $jumlahPegawai = User::all()->count();
        return view('home',compact('user','jumlahActivity','jumlahProposal','jumlahPegawai'));
    }
}
