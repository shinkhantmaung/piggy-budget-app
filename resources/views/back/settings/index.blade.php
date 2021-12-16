@extends('back.layouts.master')

@section('header')
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">
        <img src="assets/img/logo.png" alt="logo" class="logo">
    </div>
    <div class="right">
        <a href="app-notifications.html" class="headerButton">
            <ion-icon class="icon" name="notifications"></ion-icon>
            <span class="badge badge-danger">4</span>
        </a> 
        {{-- <a href="{{url('settings')}}" class="headerButton">
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged w32">
            <span class="badge badge-danger">6</span>
        </a> --}}
    </div>
</div>
@endsection


@section('content')  
    <div class="section mt-3 text-center">
        <div class="avatar-section">
            <a href="#">
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w100 rounded">
                <span class="button">
                    <ion-icon name="camera-outline"></ion-icon>
                </span>
            </a>
        </div>
        <h2 class="mt-3">{{ Auth::user()->name }}</h2>
    </div>

    <div class="listview-title mt-1">Profile Settings</div>
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
            <div class="item">
                <div class="in">
                    <div>
                        Private Profile
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2"/>
                        <label class="custom-control-label" for="customSwitch2"></label>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="listview-title mt-1">Security</div>
    <ul class="listview image-listview text mb-2">
        <li>
            <a href="#" class="item">
                <div class="in">
                    <div>Update Password</div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <div class="in">
                    <div>Log out</div>
                </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
        
@endsection