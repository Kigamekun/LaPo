<?php

namespace App\Http\Controllers;

use App\Models\{Transaction,Item,User};
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function make(Request $request, $id)
    {
        if (Auth::user()->points - Item::where('id', $id)->first()->price < 0) {
            return redirect()->back()->with(['status'=>'error','message'=>'Your points are out of range']);
        } else {
            Transaction::create([
                'transaction_code' => 'ITCOIN-'.Carbon::now()->timestamp,
                'user_id' => Auth::id(),
                'item_id' => $id,
            ]);

            User::where('id',Auth::id())->update([
                'points' => Auth::user()->points - Item::where('id', $id)->first()->price
            ]);

            return redirect()->back()->with(['status'=>'success','message'=>'Transaction has been created']);
        }
    }
}
