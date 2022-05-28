<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use App\Models\Proposal;
use App\Models\Comment;

class ProposalController extends Controller
{
    public function proposals(){
        $user = Auth::user();
        $comments = Comment::all();
        $proposals = Proposal::orderBy('created_at','DESC')->where('users_id',$user->id)->get();
        return view('proposal', compact('user','proposals','comments'));
    }

    public function getDataProposal($id){
        $proposal = Proposal::find($id);

        return response()->json($proposal);
    }

    public function getKomentar($id){
        $comment = Comment::where('proposals_id', '=', $id)->first();

        return response()->json($comment);
    }

    public function submit_proposal(Request $req){
        $proposal = new Proposal;
        $user = Auth::user();

        $req->validate([
            'fileProposal' => 'mimes:pdf'
        ]);

        $proposal->title = $req->get('title');
        $proposal->users_id = $req->get('users_id');
        if($req->hasFile('fileProposal')){
            $extension = $req->file('fileProposal')->extension();

            $filename = $user->name.'_proposal_'.time().'.'.$extension;

            $req->file('fileProposal')->storeAs(
                'public/file_proposal',$filename
            );

            $proposal->file = $filename;
        }
        $proposal->save();
        $notification = array(
            'message' => 'Proposal berhasil diajukan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.proposals')->with($notification);
    }

    public function submit_feedback(Request $req){
        $count = Comment::all()->where('proposals_id',$req->get('proposals_id'))->count();
        if($count == 0){
            $feedback = new Comment;

            $feedback->proposals_id = $req->get('proposals_id');
            $feedback->comment = $req->get('comment');
            $feedback->comment_by = $req->get('users_name');

            $feedback->save();
        }else{
        $feedback = Comment::find($req->get('proposals_id'));
        $feedback->comment = $req->get('comment');
        $feedback->comment_by = $req->get('users_name');

        $feedback->save();
        }
        $notification = array(
            'message' => 'Komentar berhasil dikirimkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.validasi_proposals')->with($notification);
    }


    public function update_proposal(Request $req){
        $proposal = Proposal::find($req->get('id'));
        $user = Auth::user();

        $req->validate([
            'fileProposal' => 'mimes:pdf'
        ]);

        if($req->hasFile('fileProposal')){
            $extension = $req->file('fileProposal')->extension();


            $filename = $user->name.'_proposal_'.time().'.'.$extension;

            $req->file('fileProposal')->storeAs(
                'public/file_proposal',$filename
            );

            Storage::delete('public/file_proposal/'.$req->get('old_fileProposal'));
            $proposal->file = $filename;
        }

        $proposal->save();
        $notification = array(
            'message' => 'Proposal berhasil diajukan ulang',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.proposals')->with($notification);
    }

    public function downloadProposal($filename){
        $path = public_path('storage/file_proposal/'.$filename);

        return response()->download($path);
    }

}
