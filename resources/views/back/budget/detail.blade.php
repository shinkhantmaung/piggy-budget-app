@extends('back.layouts.master')

@section('header')
<div class="appHeader ">
    <div class="left">
        <a href="{{url('/')}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        {{$title}}
    </div>
</div>    
@endsection

@section('content')
<!-- Transactions -->
<div class="section mt-2">
    @if (!$sorted['filtered'])
        <p class="text-center pt-5">No Transactions</p>
    @else 
        @foreach ($sorted['filtered'] as $date=>$item)
            <div class="section-title">
                @if ($date == $today)
                    Today
                @elseif($date == $yesterday)
                    Yesterday
                @else
                    {{$date}}
                @endif
            </div>
            <div class="transactions">   
                @foreach ($sorted['sorted'] as $item)
                    @if ($date == $item['date'])
                        <!-- item -->
                        <a href="{{route('transaction.show',$item['id'])}}" class="item">
                            <div class="detail">
                                @if ($item['type_id']==1)
                                    <div class="iconbox bg-white">
                                        <img src="{{asset("assets/img/sample/type/income.jpg")}}" alt="img_{{$item['type']}}" class="image-block imaged w48">
                                    </div>
                                @else 
                                    @if ($item['category_id']==1)
                                        <div class="iconbox bg-white">
                                            <img src="{{asset("assets/img/sample/type/need.jpg")}}" alt="img_{{$item['type']}}" class="image-block imaged w48">
                                        </div>  
                                    @elseif($item['category_id']==2)    
                                        <div class="iconbox bg-white">
                                            <img src="{{asset("assets/img/sample/type/want.jpg")}}" alt="img_{{$item['type']}}" class="image-block imaged w48">
                                        </div> 
                                    @elseif($item['category_id']==3)    
                                        <div class="iconbox bg-white">
                                            <img src="{{asset("assets/img/sample/type/saving.jpg")}}" alt="img_{{$item['type']}}" class="image-block imaged w48">
                                        </div> 
                                    @else
                                    <div class="iconbox bg-white">
                                        <img src="{{asset("assets/img/sample/type/adj.jpg")}}" alt="img_{{$item['type']}}" class="image-block imaged w48">
                                    </div>                                             
                                    @endif
                                @endif                                        
                                <div>
                                    <strong>{{$item['title']}}</strong>
                                    <p class="text-capitalize">
                                        @if ($item['category_id']==1)
                                            Need
                                        @elseif($item['category_id']==2)
                                            Want
                                        @elseif($item['category_id']==3)
                                            Saving
                                        @else
                                            @if ($item['type_id'] == 1)
                                                Income
                                            @else
                                                Adjustment
                                            @endif
                                        @endif                            
                                    </p>
                                </div>
                            </div>
                            <div class  ="right">
                                @if ($item['type_id']==1)
                                    <div class="price text-success">+ {{number_format($item['amount'])}} Ks</div>
                                @elseif($item['type_id']==3)
                                    @if ($item['amount']>=0)
                                        <div class="price text-danger">- {{number_format($item['amount'])}} Ks</div>
                                    @else
                                        <div class="price text-success">+ {{number_format(abs($item['amount']))}} Ks</div>
                                    @endif
                                @else
                                    <div class="price text-danger"> - {{number_format($item['amount'])}} Ks</div>
                            @endif                                                      
                            </div>
                        </a>
                        <!-- * item -->                                         
                    @endif
                @endforeach                                
            </div>                
        @endforeach 
    @endif 
</div>
<!-- * Transactions -->    
@endsection