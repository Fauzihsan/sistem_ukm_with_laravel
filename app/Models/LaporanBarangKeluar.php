<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LaporanBarangKeluar extends Model
{
    public $table = "laporanBarangKeluars";
    use HasFactory;

    protected $fillable = [
        'name',
        'qty',
    ];

    public function oleh(){
        return $this->belongsTo('App\Models\User', 'users_id');
    }
    public static function getDataItems(){
        $items = LaporanBarangKeluar::all();
        $items_filter = [];
        $no = 1;

        for($i=0; $i<$items->count();$i++){
            $items_filter[$i]['name'] = $items[$i]->name;
            $items_filter[$i]['qty'] = $items[$i]->qty;
        }
        return $items_filter;
    }
}
