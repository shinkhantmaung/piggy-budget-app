@extends('back.layouts.master')

@section('header')
<div class="appHeader" style="position: relative; z-index: 0;">
    <div class="left">
        <a href="/" class="headerButton">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Profile</div>

</div>
@endsection


@section('content')  
    <div class="section text-center">
        <div class="avatar-section">
            <a href="">
                <img src="assets/img/sample/avatar/{{ Auth::user()->avater}}" alt="avatar" class="imaged w100 rounded">
                <span class="button">
                    <ion-icon name="camera-outline"></ion-icon>
                </span>
            </a>
        </div>
        <h2 class="mt-3">{{ Auth::user()->name }}</h2>
    </div>

    <div class="listview-title mt-4">Profile Settings</div>
    <ul class="listview image-listview text">
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>Change Username</div>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>Update E-mail</div>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>Password</div>
                    <span class="text-primary">Edit</span>
                </div>
            </a>
        </li>
    </ul>

    <div class="listview-title mt-1">About & Help</div>
    <ul class="listview image-listview text mb-2">
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>What's New</div>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>FAQ</div>
                </div>
            </a>
        </li>
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>Email Developer</div>
                </div>
            </a>
        </li>        
    </ul>    

    <div class="pt-4 pb-4 text-center">
        If you have questions, want to report a bugs or just want to chat, feel free to email us anytime. Happy budgeting from the Piggy App Team!
    </div>

    <div class="p-5">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="btn btn-success btn-block btn-lg">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>


@endsection