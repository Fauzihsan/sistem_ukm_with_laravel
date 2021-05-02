<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public static function getDataRoles(){
        $roles = Role::all();
        $roles_filter = [];
        $no = 1;

        for($i=0; $i<$roles->count();$i++){
            $roles_filter[$i]['no'] = $no++;
            $roles_filter[$i]['name'] = $roles[$i]->name;
        }
        return $roles_filter;
    }
}
