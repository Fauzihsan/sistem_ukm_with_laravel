<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function activities(){
        $user = Auth::user();
        $activities = Activity::all()->where('users_id',$user->id);
        return view('activities', compact('user','activities'));
    }

    public function getDataActivity($id){
        $activity = Activity::find($id);

        return response()->json($activity);
    }

    public function submit_activity(Request $req){
        $activity = new Activity;


        $req->validate([
            'poster' => 'mimes:jpg,png,jpeg'
        ]);

        $activity->title = $req->get('title');
        $activity->description = $req->get('description');
        $activity->users_id = $req->get('users_id');
        if($req->hasFile('poster')){
            $extension = $req->file('poster')->extension();

            $filename = 'poster_activity'.time().'.'.$extension;

            $req->file('poster')->storeAs(
                'public/poster_activity',$filename
            );

            $activity->poster = $filename;
        }

        $activity->save();
        $notification = array(
            'message' => 'Aktivitas terbaru berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.activities')->with($notification);
    }


    public function update_activity(Request $req){
        $activity = Activity::find($req->get('id'));


        $req->validate([
            'poster' => 'mimes:jpg,png,jpeg'
        ]);

        $activity->title = $req->get('title');
        $activity->description = $req->get('description');
        $activity->users_id = $req->get('users_id');
        if($req->hasFile('poster')){
            $extension = $req->file('poster')->extension();

            $filename = 'poster_activity'.time().'.'.$extension;

            $req->file('poster')->storeAs(
                'public/poster_activity',$filename
            );

            Storage::delete('public/poster_activity/'.$req->get('old_poster'));
            $activity->poster = $filename;
        }

        $activity->save();
        $notification = array(
            'message' => 'Aktivitas berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.activities')->with($notification);
    }


    public function delete_activity(Request $req){
        $activity = Activity::find($req->get('id'));

        Storage::delete('public/poster_activity/'.$req->get('old_poster'));
        $activity->delete();

        $notification = array(
            'message' => 'Aktivitas berhasil dihapus',
            'alert-type' => 'success'

        );
        return redirect()->route('admin.activities')->with($notification);
    }
}
