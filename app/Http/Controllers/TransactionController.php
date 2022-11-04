<?php

namespace App\Http\Controllers;

use App\Models\{Transaction,Item,User};
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

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
