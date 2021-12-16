@extends('back.layouts.master')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Transactions
    </div>
    <div class="right">
        <a href="app-notifications.html" class="headerButton">
            <ion-icon class="icon" name="notifications-outline"></ion-icon>
            <span class="badge badge-danger">4</span>
        </a>
    </div>
</div>    
@endsection

@section('content')
        <!-- Transactions -->
        <div class="section mt-2">
            @foreach ($filtered as $date=>$item)
            <div class="section-title">
                @if ($date == $today)
                    Today
                @else
                    {{$date}}
                @endif
            </div>
            <div class="transactions">   
                @foreach ($sorted as $item)
                    @if ($date == $item['date'])
                        <!-- item -->
                        <a href="{{route('transaction.show',$item['id'])}}" class="item">
                            <div class="detail">
                                <img src="assets/img/sample/brand/1.jpg" alt="img" class="image-block imaged w48">
                                <div>
                                    <strong>{{$item['title']}}</strong>
                                    <p>{{$item['type']}}</p>
                                </div>
                            </div>
                            <div class  ="right">
                                @if ($item['type']=='income')
                                    <div class="price text-success">+ {{$item['amount']}} Ks</div>
                                @else
                                    <div class="price text-danger"> - {{$item['amount']}} Ks</div>
                                @endif              
                            </div>
                        </a>
                        <!-- * item -->                          
                    @endif
                @endforeach                                
            </div>                
            @endforeach
        </div>
        <!-- * Transactions -->    
@endsection