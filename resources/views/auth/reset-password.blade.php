@extends('layout.master')
@section('title', 'Reset Password')
@section('container')
    <!-- Normal Breadcrumb Begin -->
    <!-- Normal Breadcrumb End -->
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/normal-breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Reset Password</h2>
                        <p>Enter your new password.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reset Password Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login__form">
                        <h3>Reset Password</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input__item">
                                <input type="email" placeholder="Email address" name="email" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="New Password" name="password" required>
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                <span class="icon_lock"></span>
                            </div>
                            <button type="submit" class="site-btn">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Reset Password Section End -->
@endsection
