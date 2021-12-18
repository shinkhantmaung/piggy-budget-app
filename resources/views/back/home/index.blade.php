@extends('back.layouts.master')

@section('header')
    @include('back.layouts.header')
@endsection

@section('content')
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Total Balance</span>
                        <h1 class="total">{{number_format($total,2)}} Ks</h1>
                    </div>
                    <div class="right">
                        <a href="#" class="button" data-toggle="modal" data-target="#adjustmentActionSheet">
                            <ion-icon name="build-outline"></ion-icon>
                        </a>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" data-toggle="modal" data-target="#incomeActionSheet">
                            <div class="icon-wrapper bg-success">
                                <ion-icon name="arrow-up-outline"></ion-icon>
                            </div>
                            <strong>Income</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-toggle="modal" data-target="#expenseActionSheet">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            <strong>Expenses</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" onclick="return alert()->info('InfoAlert','Lorem ipsum dolor sit amet.');
                            ">
                            <div class="icon-wrapper bg-secondary">
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                            <strong>Report</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#">
                            <div class="icon-wrapper bg-warning">
                                <ion-icon name="receipt-outline"></ion-icon>
                            </div>
                            <strong>Bill</strong>
                        </a>
                    </div>

                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->
        
        {{-- modals  --}}
        <!-- Adjustment Action Sheet -->
        @include('back.home.modals.adjustment_action')
        <!-- * Adjustment Action Sheet -->        

        <!-- Expense Action Sheet -->
        @include('back.home.modals.expense_action')
        <!-- * Expense Action Sheet -->

        <!-- Income Action Sheet -->
        @include('back.home.modals.income_action')
        <!-- * Income Action Sheet -->   

        <!-- Stats -->
        <div class="section">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Income</div>
                        <div class="value text-success">{{number_format($income)}} Ks</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Expenses</div>
                        <div class="value text-danger">{{number_format($expense)}} Ks</div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="stat-box">
                        <div class="title">Savings</div>
                        <div class="value">{{number_format($saving)}} Ks</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->

        <!-- Transactions -->
        @include('back.home.transactions')
        <!-- * Transactions -->

        <!-- Monthly Bills -->
        {{-- @include('back.home.bills') --}}
        <!-- * Monthly Bills -->   
        
@endsection