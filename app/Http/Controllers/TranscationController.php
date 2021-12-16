<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Transactions";
        $today = Carbon::now()->format('Y-m-d');
        $transactions = Transaction::where('user_id','=',auth()->user()->id)->get();
        $sorted = $transactions->sortBy([
            ['created_at', 'desc'],
        ]);
        
        $sorted->values()->all();

        // Set a new array
        $filtered = [];

        // Loop the transactions
        foreach($sorted as $v)
        {
            // Group the transactions into their respective date
            $filtered[$v['date']][] = $v;
        }

        // Filter out any date 
        $filtered = array_filter($filtered, function($v){
            return count($v) > 1;
        });
        // print_r($filtered);
        return view('back.transactions.transaction', compact('title','filtered','sorted','today'));  
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
        $validator = validator(request()->all(), [
            'title' => 'required',
            'amount' => 'required'
        ]);

        if($validator->fails()) {
        return back()->withErrors($validator);
        }
        // Transaction::create($request->all());
        $transaction = new Transaction;
        $transaction->title = request()->title;
        $transaction->type = request()->type;
        $transaction->amount = request()->amount;
        $transaction->date =  Carbon::now()->toDateTimeString();
        $transaction->user_id = auth()->user()->id;
        $transaction->save();

        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::where('id',$id)->first();
        $title = $transaction['title'];
        return view('back.transactions.transaction_detail',compact('title','transaction'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::where('id',$id)->delete();
        return redirect()->route('transaction.index');
    }
    
}
