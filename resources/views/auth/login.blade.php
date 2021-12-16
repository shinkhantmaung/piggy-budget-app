@extends('back.layouts.master')

@section('content')
    <div class="section mt-2 text-center">
        <h1>Log in</h1>
        <h4>Fill the form to log in</h4>
    </div>
    <div class="section mt-2 mb-5 p-3">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="email1">E-mail</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="password1">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-links mt-2">
                <div>
                    <a href="{{url('register')}}">Register Now</a>
                </div>
                @if (Route::has('password.request'))
                <div>
                    <a class="text-muted" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>                    
                </div>
                @endif
            </div>

            <div class="form-button-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
            </div>
        </form>
    </div>
<style>
.appHeader{
    display: none;
}
.appBottomMenu{
    display: none;
}
</style>
@endsection
