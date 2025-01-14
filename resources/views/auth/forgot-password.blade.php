@extends('layout.master')
@section('title', 'Forgot Password')
@section('container')
    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Forgot Password</h2>
                        <p>Enter your email to reset your password.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Forgot Password Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login__form">
                        <h3>Forgot Password</h3>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="input__item">
                                <input type="email" placeholder="Email address" name="email" required>
                                <span class="icon_mail"></span>
                            </div>
                            <button type="submit" class="site-btn">Send Password Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Forgot Password Section End -->
@endsection
