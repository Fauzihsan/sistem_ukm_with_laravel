<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function users(){
        $user = Auth::user();
        $users = User::all();
        $roles = Role::all();
        return view('user', compact('user','users','roles'));
    }


    public function getDataUser($id){
        $user = User::find($id);

        return response()->json($user);
    }

    public function submit_user(Request $req){
        $user = new User;

        $req->validate([
            'photo' => 'mimes:jpg,png,jpeg'
        ]);

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $newPassword = $req->get('password');
        $user->password = bcrypt($newPassword);
        $user->roles_id = $req->get('roles_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user'.time().'.'.$extension;

            $req->file('photo')->storeAs(
                'public/photo_user',$filename
            );

            $user->photo = $filename;
        }

        $user->save();
        $notification = array(
            'message' => 'User Baru berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.users')->with($notification);
    }


    public function update_user(Request $req){
        $user = User::find($req->get('id'));

        $req->validate([
            'photo' => 'mimes:jpg,png,jpeg'
        ]);

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->roles_id = $req->get('roles_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user'.time().'.'.$extension;

            $req->file('photo')->storeAs(
                'public/photo_user',$filename
            );

            Storage::delete('public/photo_user/'.$req->get('old_photo'));
            $user->photo = $filename;
        }

        $user->save();
        $notification = array(
            'message' => 'Data User berhasil diubah',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.users')->with($notification);
    }


    public function delete_user(Request $req){
        $user = User::find($req->get('id'));

        Storage::delete('public/photo_user/'.$req->get('old_photo'));
        $user->delete();

        $notification = array(
            'message' => 'User berhasil dihapus',
            'alert-type' => 'success'

        );
        return redirect()->route('admin.users')->with($notification);
    }

}
