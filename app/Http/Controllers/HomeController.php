<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() 
    {
        $categories = [
            ['id'=>1,'title'=>'Need'],
            ['id'=>2,'title'=>'Want'],
            ['id'=>3,'title'=>'Saving']
        ];

        $title = "Home";
        $month = Carbon::today()->month;
        $transactions = Transaction::query();
        
        $transactions = $transactions->where('user_id',auth()->user()->id)->whereMonth('date',$month)->latest();

        $adj= (clone $transactions)->where('type_id',3)->sum("amount");
        $income= (clone $transactions)->where('type_id',1)->sum("amount")+$adj;
        $expense= (clone $transactions)->where('type_id',2)->sum("amount") ;
        $saving = (clone $transactions)->where('category_id',3)->sum("amount");
        $total = $this->CalculateTotal($transactions);
        
        $transactions = $transactions->Paginate(5);

        return view('back.home.index', compact('categories','title','transactions','income','expense','total','saving'));  
    }

    //Calcallate All Total Amount of Transactions
    private function CalculateTotal($transactions)
    {
        $transactions = (clone $transactions)->get();

        $income = 0;
        $expense = 0;
        $adj = 0;

        foreach ($transactions as $value) {
            if ($value['type_id']==2) {
                $expense += $value['amount'];
            }
            elseif($value['type_id']==3)
            {
                $adj += $value['amount'];
            }
            else{
                $income += $value['amount'];
            }
        }
        return ($income - $expense)+$adj;
    }
}
