@extends('user.auth.master')

@section('auth-content')

<div class="row justify-content-center pt-5">
    <div class="col-md-7">
       <div class="card auth-card iq-auth-form custom-card">
          <div class="card-body">
             <h2 class="mb-2 text-center" style="color:#46ff27;">Sign In</h2>
             <p class="text-center">Login to stay connected.</p>
             <form action="{{ route('post.login') }}" class="form w-100" method="post" novalidate="novalidate">
                @csrf
                <div class="row">
                   <div class="col-lg-12">
                      <div class="form-group">
                         <label for="email" class="form-label">Email</label>
                         <input type="email" name="email" class="form-control" id="email" placeholder="xyz@example.com">
                      </div>
                   </div>
                   <div class="col-lg-12">
                      <div class="form-group">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" name="password" class="form-control" id="password" placeholder="xxxx">
                      </div>
                   </div>

                   <!-- Google reCAPTCHA -->
                   <div class="col-lg-12 text-center mt-3">
                      <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
                   </div>

                   <div class="col-lg-12 d-flex justify-content-between">
                      <a href="recoverpw.html">Forgot Password?</a>
                   </div>
                </div>

                <div class="d-flex justify-content-center">
                   <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
                <p class="mt-3 text-center">
                   Don’t have an account? <a href="{{ route('signUp') }}" class="text-underline">Click here to sign up.</a>
                </p>
             </form>
          </div>
       </div>
    </div>
</div>

<!-- reCAPTCHA Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
   .custom-card {
       background: rgba(255, 255, 255, 0.9); /* সাদা শেডেড ব্যাকগ্রাউন্ড */
       color: black; /* টেক্সট কালার ব্ল্যাক */
       border-radius: 10px; /* কোণা কিছুটা গোল করা */
       box-shadow: 0 4px 15px rgba(255, 255, 255, 0.5); /* হালকা সাদা শ্যাডো */
       padding: 20px;
   }
   .custom-card .form-control {
       background: rgba(255, 255, 255, 0.7); /* ইনপুট ফিল্ড হালকা ট্রান্সপারেন্ট */
       border: 1px solid #ddd;
       color: black;
   }
   .custom-card .form-control::placeholder {
       color: rgba(0, 0, 0, 0.6);
   }
   .custom-card .btn-primary {
       background: #46ff27;
       border: none;
   }
   .custom-card .btn-primary:hover {
       background: #32cc1a;
   }
</style>

@endsection
