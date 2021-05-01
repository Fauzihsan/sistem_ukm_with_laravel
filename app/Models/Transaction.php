<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo('App\Models\Product', 'products_id');
    }

    public static function getDataTransactions(){
        $transactions = Transaction::all();
        $transactions_filter = [];
        $no = 1;

        for($i=0; $i<$transactions->count();$i++){
            $transactions_filter[$i]['products_id'] = $transactions[$i]->products_id;
            $transactions_filter[$i]['qty'] = $transactions[$i]->qty;
            $transactions_filter[$i]['total'] = $transactions[$i]->total;
            $transactions_filter[$i]['pembayaran'] = $transactions[$i]->pembayaran;
            $transactions_filter[$i]['kembalian'] = $transactions[$i]->kembalian;
            $transactions_filter[$i]['customer'] = $transactions[$i]->customer;
            $transactions_filter[$i]['cashier'] = $transactions[$i]->cashier;
        }
        return $products_filter;
    }
}
