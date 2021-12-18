<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use App\Models\Transaction;
use Carbon\Carbon;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = "Budget";
        $month = Carbon::today()->month;
        $transactions = Transaction::query();
        
        $transactions = $transactions->where('user_id',auth()->user()->id)->whereMonth('date',$month)->latest();

        $adj= (clone $transactions)->where('type_id',3)->sum("amount");
        $income= (clone $transactions)->where('type_id',1)->sum("amount")+$adj;
        $expense= (clone $transactions)->where('type_id',2)->sum("amount") ;
        $budget = $this->budget($transactions);

        $spending = [
            'need' => (clone $transactions)->where('category_id',1)->sum('amount'),
            'want' => (clone $transactions)->where('category_id',2)->sum('amount'),
            'saving' => (clone $transactions)->where('category_id',3)->sum('amount'),
        ];

        $chart = LarapexChart::pieChart()
        ->addData([(int)$spending['need'],(int)$spending['want'],(int)$spending['saving']])
        ->setLabels(['Need', 'Want', 'Saving'])
        ->setColors(['#5fb8fb', '#dc3545','#1dcc70']);

        return view('back.budget.index', compact('title','chart','spending','expense','income','budget'));
    }

    public function show($category)
    {
        if ($category == 'need') {
            $category_id = 1;
            $title = 'Need';
        }
        elseif($category == 'want'){
            $category_id = 2;
            $title = 'Want';
        }elseif($category == 'saving'){
            $category_id = 3;
            $title = 'Saving';
        }

        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $month = Carbon::today()->month;

        $transactions = Transaction::where('user_id',auth()->user()->id)->whereMonth('date',$month);
        $transactions = (clone $transactions)->where('category_id',$category_id);

        $sorted = $this->sorted($transactions);

        return view('back.budget.detail',compact('title','sorted','today','yesterday'));  
    }

    private function budget($transactions)
    {
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
    private function sorted($transactions)
    {
        $sorted =  (clone $transactions)->get();

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
}
