<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;

class ProposalValidationController extends Controller
{

    public function validasi_proposals(){
        $user = Auth::user();
        $proposalsForBem = Proposal::orderBy('created_at','DESC')->get();
        $proposalsForBlm = Proposal::orderBy('created_at','DESC')->where('validated_bem',1)->get();
        $proposalsForPembimbing = Proposal::orderBy('created_at','DESC')->where('validated_blm',1)->get();
        $proposalsForWd3 = Proposal::orderBy('created_at','DESC')->where('validated_pembimbing',1)->get();
        $proposalsForDekan = Proposal::orderBy('created_at','DESC')->where('validated_wd3',1)->get();
        $proposalsForBaak = Proposal::orderBy('created_at','DESC')->where('validated_dekan',1)->get();


        // $proposals = Proposal::leftJoin('comments', 'comments.proposals_id', '=', 'proposals.id')->select('proposals.*', 'comments.*')->get()->where('users_id',$user->id);
        $comments = Comment::all();
        return view('validasi_proposal', compact('user','proposalsForBem','proposalsForBlm','proposalsForPembimbing','proposalsForWd3','proposalsForDekan','proposalsForBaak','comments'));
    }


    public function getDataProposal($id){
        $proposal = Proposal::find($id);

        return response()->json($proposal);
    }

    public function update_validasi_proposal_bem(Request $req){
        $proposal = Proposal::find($req->get('id'));
        $proposal->validated_bem = !$req->get('validated_bem');
        $proposal->save();
        $notification = array(
            'message' => 'Proposal Berhasil disetujui',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.validasi_proposals')->with($notification);

    }
    public function update_validasi_proposal_blm(Request $req){
        $proposal = Proposal::find($req->get('id'));
        $proposal->validated_blm = !$req->get('validated_blm');
        $proposal->save();
        $notification = array(
            'message' => 'Proposal Berhasil disetujui',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.validasi_proposals')->with($notification);
    }
    public function update_validasi_proposal_pembimbing(Request $req){
        $proposal = Proposal::find($req->get('id'));
        $proposal->validated_pembimbing = !$req->get('validated_pembimbing');
        $proposal->save();
        $notification = array(
            'message' => 'Proposal Berhasil disetujui',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.validasi_proposals')->with($notification);
    }
    public function update_validasi_proposal_wd3(Request $req){
        $proposal = Proposal::find($req->get('id'));
        $proposal->validated_wd3 = !$req->get('validated_wd3');
        $proposal->save();
        $notification = array(
            'message' => 'Proposal Berhasil disetujui',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.validasi_proposals')->with($notification);
    }
    public function update_validasi_proposal_dekan(Request $req){
        $proposal = Proposal::find($req->get('id'));
        $proposal->validated_dekan = !$req->get('validated_dekan');
        $proposal->status = "Disetujui";
        $proposal->save();
        $notification = array(
            'message' => 'Proposal Berhasil disetujui',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.validasi_proposals')->with($notification);
    }
}
