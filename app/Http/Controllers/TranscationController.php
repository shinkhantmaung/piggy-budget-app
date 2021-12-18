<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        $transactions = Transaction::query();
        $transactions = Transaction::where('user_id',auth()->user()->id);
        $sorted = $this->sorted($transactions);

        $budget = $this->budget();
        return view('back.transactions.index', compact('title','sorted','today','yesterday'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'amount' => 'required',
        ]);

        if ($request->type_id==3) {
            $amount = $request->amount - $request->total;
        }
        else {
            $amount = $request->amount;
        }

        $isBudget = $this->isBudget($amount,$request->get('category_id'));

        Transaction::create([
            'title' => $request->get('title'),
            'type_id'  => $request->get('type_id'),
            'amount'=> $amount,
            'isbudget'=> $isBudget,
            'date'  => Carbon::now()->toDateTimeString(),
            'category_id'=> $request->get('category_id'),
            'user_id'=> auth()->user()->id,
        ]);

        if ($isBudget == false) {
            alert()->warning('Over Budget',$request->title.' is over budget!');
        }else{
            toast('Successfully Create','success');
        }

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
        $amount = $transaction['amount'];
        $category_id = $transaction['category_id'];
        $isBudget = $this->isBudget($amount,$category_id);

        return view('back.transactions.detail',compact('title','transaction','isBudget'));   
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

        toast('Delete Successfully!','success');
        return redirect()->route('home.index');
    }
    
    private function sorted($transactions)
    {
        $sorted =  (clone $transactions)->orderBy('created_at', 'desc')->get();

        // Set a new array
        $filtered = [];

        // Loop the transactions
        foreach($sorted as $v)
        {
            // Group the transactions into their respective date
            $filtered[$v['date']][] = $v;
        }

        return ['sorted'=>$sorted,'filtered'=>$filtered];
    }

    private function budget()
    {
        $month = Carbon::today()->month;
        $transactions = Transaction::where('user_id',auth()->user()->id)->whereMonth('date',$month)->latest();

        $adj= (clone $transactions)->where('type_id',3)->sum("amount");
        $income= (clone $transactions)->where('type_id',1)->sum("amount")+$adj;

        $need = (50/100*$income);
        $want = (30/100*$income);
        $saving = (20/100*$income);

        return [
            'need'=>$need,
            'want'=>$want,
            'saving'=>$saving
        ];
    }

    private function isBudget($amount,$category_id)
    {
        $budget = $this->budget();
        $isBudget = false;

        if ($category_id == 1 && $amount < $budget['need']) {
            $isBudget = true;
        }
        elseif($category_id == 2 && $amount < $budget['want'] ){
            $isBudget = true;
        }
        elseif($category_id == 3 && $amount < $budget['saving']){
            $isBudget = true;
        }else{
            $isBudget = false;
        }

        return $isBudget;
    }
}
