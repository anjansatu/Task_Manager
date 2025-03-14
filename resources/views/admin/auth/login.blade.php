@extends('user.auth.master')

@section('auth-content')
<a href="{{ asset('dashboard/index.html') }}" class="navbar-brand d-flex align-items-center mb-3 justify-content-center text-primary">
    <div class="logo-normal">
        <svg viewBox="0 0 32 32" width="80px" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25333 2H22.0444L29.7244 15.2103L22.0444 28.1333H7.25333L0 15.2103L7.25333 2ZM11.2356 9.32316H18.0622L21.3334 15.2103L18.0622 20.9539H11.2356L8.10669 15.2103L11.2356 9.32316Z" fill="currentColor"/>
            <path d="M23.751 30L13.2266 15.2103H21.4755L31.9999 30H23.751Z" fill="#3FF0B9"/>
        </svg>
    </div>
    <h2 class="logo-title ms-3 mb-0" data-setting="app_name">Qompac UI</h2>
</a>
<div class="row justify-content-center pt-5">
    <div class="col-md-9">
        <div class="card d-flex justify-content-center mb-0 auth-card iq-auth-form">
            <div class="card-body">
                <h2 class="mb-2 text-center">Sign In</h2>
                <p class="text-center">Login to stay connected.</p>
                <form action="{{ route('admin.postLogin') }}" class="form w-100" method="post" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="xyz@example.com" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="****" required>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
