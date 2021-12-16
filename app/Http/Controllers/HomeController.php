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
        $title = "Home";
        $transaction = Transaction::where('user_id','=',auth()->user()->id);
        $transactions = Transaction::where('user_id','=',auth()->user()->id)->latest()->Paginate(7);
        $income = 0;
        $expense = 0;
        foreach ($transactions as $key => $value) {
            if ($value['type']=='income') {
                $income = $income + $value['amount'];
            }
            else{
                $expense = $expense + $value['amount'];
            }
        }
        $total = $income - $expense;
        return view('back.home', compact('title','transaction','transactions','income','expense','total'));  
    }
}
