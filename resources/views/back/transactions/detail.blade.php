@extends('back.layouts.master')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Transaction Details
    </div>
    <div class="right">
        <form action="{{route('transaction.destroy',$transaction['id'])}}" method="POST">
            @csrf
            <button type="submit" class="headerButton btn btn-link">
                <ion-icon name="trash-outline"></ion-icon>
            </button>
        </form>

    </div>
</div>    
@endsection

@section('content')
<div class="section mt-2 mb-2">


    <div class="listed-detail mt-3">
        <div class="icon-wrapper">
            @if ($transaction['type_id']==1)
                <div class="">
                    <img src="{{asset("assets/img/sample/type/income.jpg")}}" alt="img_{{$transaction['type']}}" class="image-block imaged rounded" style="width: 80px;">
                </div>
            @else 
                @if ($transaction['category_id']==1)
                    <div class="">
                        <img src="{{asset("assets/img/sample/type/need.jpg")}}" alt="img_{{$transaction['type']}}" class="image-block imaged rounded" style="width: 80px;">
                    </div>  
                @elseif($transaction['category_id']==2)    
                    <div class="">
                        <img src="{{asset("assets/img/sample/type/want.jpg")}}" alt="img_{{$transaction['type']}}" class="image-block imaged rounded" style="width: 80px;">
                    </div> 
                @elseif($transaction['category_id']==3)    
                    <div class="">
                        <img src="{{asset("assets/img/sample/type/saving.jpg")}}" alt="img_{{$transaction['type']}}" class="image-block imaged rounded" style="width: 80px;">
                    </div> 
                @else
                <div class="">
                    <img src="{{asset("assets/img/sample/type/adj.jpg")}}" alt="img_{{$transaction['type']}}" class="image-block imaged rounded" style="width: 80px;">
                </div>                                             
                @endif
            @endif
        </div>
        <h3 class="text-center mt-2 text-uppercase">{{$transaction['title']}}</h3>
    </div>

    <ul class="listview flush transparent simple-listview no-space mt-3">
        @if ($transaction->type_id == 2)
            <li>
                <strong>Budget</strong>
                @if ($transaction['isbudget'] == true)
                    <span class="text-success">In Budget</span>
                @else 
                    <span class="text-danger">Over Budget</span>
                @endif
            </li>            
        @endif
        <li>
            <strong>Transaction Category</strong>
            <span class="text-capitalize">
                @if ($transaction['category_id']==1)
                    Need
                @elseif($transaction['category_id']==2)
                    Want
                @elseif($transaction['category_id']==3)
                    Saving
                @else
                    @if ($transaction['type_id']==1)
                        Income
                    @else 
                        Adjustment
                    @endif
                @endif
            </span>
        </li>
        <li>
            <strong>Date</strong>
            <span>{{($transaction['date'])}}</span>
        </li>
        <li>
            <strong>Amount</strong>
            @if ($transaction['type']=='income')
                <h3 class="m-0 price text-success">+ {{number_format($transaction['amount'])}} Ks</h3>
            @elseif($transaction['type']=='adj')
                @if ($transaction['amount']>=0)
                    <h3 class="m-0 price text-danger">- {{number_format($transaction['amount'])}} Ks</h3>
                @else
                    <h3 class="m-0 price text-success">+ {{number_format(abs($transaction['amount']))}} Ks</h3>
                @endif
            @else
                <h3 class="m-0 price text-danger"> - {{number_format($transaction['amount'])}} Ks</h3>
            @endif              
            {{-- <h3 class="m-0">{{number_format(abs($transaction['amount']))}} Ks</h3> --}}
        </li>
    </ul>
</div>  

@endsection