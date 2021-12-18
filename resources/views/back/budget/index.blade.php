@extends('back.layouts.master')

@section('header')
<div class="appHeader ">
    <div class="pageTitle">
        Budget
    </div>
</div>    
@endsection

@section('content')
<div class="section mt-4"> 
    <div class="wallet-card">
        <div class="balance">
            <div class="left">
                <span class="title">Spending Balance</span>
                <h1 class="total">{{number_format($expense,2)}} Ks</h1>
            </div>
        </div>
        {!! $chart->container() !!}
        <script src="{{ $chart->cdn() }}"></script>
        {!! $chart->script() !!}
    </div>
</div>
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">All Budget</h2>
    </div>
    <div class="transactions">
        <!-- item -->
        <a href="{{route('budget.show','need')}}" class="item">
            <div class="detail">
                <div class="iconbox bg-white">
                    <img src="{{asset("assets/img/sample/type/need.jpg")}}" alt="need" class="image-block imaged w48">
                </div>                    
                <div>
                    <strong>Need</strong>
                    <p> {{$spending['need']}} Ks used</p>
                </div>
            </div>
            <div class="right">
                    <div class="price text-dark">{{number_format($budget['need']-$spending['need'])}} Ks left</div>             
            </div>
        </a>
        <!-- * item -->  
        <!-- item -->
        <a href="{{route('budget.show','want')}}" class="item">
            <div class="detail">
                <div class="iconbox bg-white">
                    <img src="{{asset("assets/img/sample/type/want.jpg")}}" alt="want" class="image-block imaged w48">
                </div>                    
                <div>
                    <strong>Want</strong>
                    <p>  
                        {{$spending['want']}} Ks used                        
                    </p>
                </div>
            </div>
            <div class="right">
                    <div class="price text-dark">{{number_format($budget['want']-$spending['want'])}} Ks left</div>             
            </div>
        </a>
        <!-- * item -->  
        <!-- item -->
        <a href="{{route('budget.show','saving')}}" class="item">
            <div class="detail">
                <div class="iconbox bg-white">
                    <img src="{{asset("assets/img/sample/type/saving.jpg")}}" alt="need" class="image-block imaged w48">
                </div>                    
                <div>
                    <strong>Saving</strong>
                    <p> {{$spending['saving']}} Ks saved</p>
                </div>
            </div>
            <div class="right">
                    <div class="price text-dark">{{number_format($budget['saving']-$spending['saving'])}} Ks left</div>             
            </div>
        </a>
        <!-- * item -->                  
    </div>
</div>
@endsection