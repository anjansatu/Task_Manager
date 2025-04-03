@extends('user.auth.master')

@section('auth-content')
<div class="auth-container d-flex flex-column align-items-center justify-content-center">
    {{-- Logo Section with Yellow Gradient Background --}}
    <div class="logo-container text-center">
        <div class="logo-bg d-flex flex-column align-items-center justify-content-center">
            <a href="{{ asset('dashboard/index.html') }}" class="navbar-brand d-flex align-items-center justify-content-center text-primary">
                <!--<div class="logo-normal">-->
                <!--    <svg viewBox="0 0 32 32" width="80px" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                <!--        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25333 2H22.0444L29.7244 15.2103L22.0444 28.1333H7.25333L0 15.2103L7.25333 2ZM11.2356 9.32316H18.0622L21.3334 15.2103L18.0622 20.9539H11.2356L8.10669 15.2103L11.2356 9.32316Z" fill="currentColor"/>-->
                <!--        <path d="M23.751 30L13.2266 15.2103H21.4755L31.9999 30H23.751Z" fill="#3FF0B9"/>-->
                <!--    </svg>-->
                <!--</div>-->
                <h2 class="logo-title ms-3 mb-0 text-white" data-setting="app_name">SSN PRO ADMIN</h2>
            </a>
        </div 
    </div>

    {{-- Login Form Section --}}
    <div class="form-container">
        <div class="card auth-card iq-auth-form shadow-lg p-4">
            <div class="card-body">
                <h2 class="mb-2 text-center text-white">Sign In</h2>
                <p class="text-center text-white">Login to stay connected.</p>
                <form action="{{ route('admin.postLogin') }}" class="form w-100" method="post" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email" class="form-label text-white">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="xyz@example.com" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password" class="form-label text-white">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="****" required>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-light w-100">Sign In</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Additional CSS for Styling --}}
<style>
    body {
        background-color: #f8f9fa;
    }

    .auth-container {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Logo Background with Yellow Gradient */
    .logo-bg {
        width: 100%;
        max-width: 400px;
        height: 120px;
        background: linear-gradient(135deg, #FFD700, #FFAE42);
        border-radius: 15px;
        padding: 10px;
    }

    .logo-normal svg {
        width: 70px;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
    }

    /* Login Form with Blue-Purple Gradient */
    .auth-card {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border-radius: 15px;
    }

    .auth-card .form-control {
        border-radius: 10px;
    }

    .auth-card .btn {
        border-radius: 10px;
        font-size: 16px;
        padding: 10px;
    }

    @media (max-width: 768px) {
        .auth-container {
            padding: 20px;
        }
        .logo-bg {
            height: 100px;
            max-width: 320px;
        }
        .logo-normal svg {
            width: 60px;
        }
        .logo-title {
            font-size: 18px;
        }
    }
</style>
@endsection
