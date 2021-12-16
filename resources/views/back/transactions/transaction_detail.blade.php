@extends('back.layouts.master')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Transaction Detail
    </div>
    <div class="right">
        <form action="{{route('transaction.destroy',$transaction['id'])}}" method="POST">
            @csrf
            
            <button type="submit" class="headerButton">
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
            <div class="iconbox">
                <ion-icon name="arrow-forward-outline"></ion-icon>
            </div>
        </div>
        <h3 class="text-center mt-2">{{$transaction['type']}}</h3>
    </div>

    <ul class="listview flush transparent simple-listview no-space mt-3">
        <li>
            <strong>Name</strong>
            <span>{{$transaction['title']}}</span>
        </li>
        <li>
            <strong>Status</strong>
            <span class="text-success">Success</span>
        </li>
        <li>
            <strong>Transaction Category</strong>
            <span>{{$transaction['type']}}</span>
        </li>
        <li>
            <strong>Date</strong>
            <span>{{$transaction['date']}}</span>
        </li>
        <li>
            <strong>Amount</strong>
            <h3 class="m-0">{{$transaction['amount']}} Ks</h3>
        </li>
    </ul>


</div>    
@endsection