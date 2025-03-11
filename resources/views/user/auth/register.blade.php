@extends('user.auth.master')

@section('auth-content')

<div class="row justify-content-center pt-5">
    <div class="col-md-7">
       <div class="card auth-card iq-auth-form custom-card">
          <div class="card-body">
             <h2 class="mb-2 text-center" style="color:#46ff27;">Sign Up</h2>
             <form class="form w-100" action="{{ route('post.signUp') }}" method="post">
                @csrf
                <div class="row">
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="name" class="form-label">Name</label>
                         <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name') }}" />
                         @error('name')
                            <div class="alert text-danger">{{ $message }}</div>
                         @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="username" class="form-label">User Name</label>
                         <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ old('username') }}" />
                         @error('username')
                            <div class="alert text-danger">{{ $message }}</div>
                         @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="email" class="form-label">Email</label>
                         <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" />
                         @error('email')
                            <div class="alert text-danger">{{ $message }}</div>
                         @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="phone_number" class="form-label">Phone No.</label>
                         <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="123456789" value="{{ old('phone_number') }}" />
                         @error('phone_number')
                            <div class="alert text-danger">{{ $message }}</div>
                         @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
                         @error('password')
                            <div class="alert text-danger">{{ $message }}</div>
                         @enderror
                      </div>
                   </div>
                   <div class="col-lg-6">
                      <div class="form-group">
                         <label for="password_confirmation" class="form-label">Confirm Password</label>
                         <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Repeat Password" />
                         @error('password_confirmation')
                            <div class="alert text-danger">{{ $message }}</div>
                         @enderror
                      </div>
                   </div>

                   <!-- Google reCAPTCHA -->
                   <div class="col-lg-12 text-center mt-3">
                      <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
                   </div>

                </div>

                <div class="d-flex justify-content-center">
                   <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>

                <p class="mt-3 text-center">
                   Already have an account? <a href="{{ route('login') }}" class="text-underline">Sign In</a>
                </p>
             </form>
          </div>
       </div>
    </div>
</div>

<!-- reCAPTCHA Script -->

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


@section('js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const phoneInput = document.querySelector("#phone");
        const phoneNumberError = document.querySelector("#phone_numberError");
        const passwordError = document.querySelector("#passwordError");
        const usernameField = document.querySelector("#username");
        const passwordField = document.querySelector('#password_confirmation');

        if (phoneInput) {
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "LT",
                separateDialCode: true,
                excludeCountries: ["ae", "us", "ca"],
                geoIpLookup: function(callback) {
                    fetch("https://ipapi.co/json")
                        .then(response => response.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("cy"));
                },
            });

            phoneInput.addEventListener("input", function() {
                const isValid = iti.isValidNumber();
                if (isValid) {
                    setPhoneValues(iti);
                    phoneInput.setCustomValidity("");
                } else {
                    phoneInput.setCustomValidity("Invalid phone number");
                }
            });

            function setPhoneValues(iti) {
                const countryData = iti.getSelectedCountryData();
                document.querySelector("#country").value = countryData.name;
                document.querySelector("#dial_code").value = countryData.dialCode;
                document.querySelector("#phone").value = iti.getNumber();
            }
        }

        function toggleVisibility() {
            const openeye = document.querySelector("#openeye");
            const closeeye = document.querySelector("#closeeye");
            if (passwordField.getAttribute('type') === 'password') {
                passwordField.setAttribute('type', 'text');
                openeye.classList.remove("hidden");
                closeeye.classList.add("hidden");
            } else {
                passwordField.setAttribute('type', 'password');
                closeeye.classList.remove("hidden");
                openeye.classList.add("hidden");
            }
        }

        document.querySelectorAll("input[name='password'], input[name='password_confirmation']").forEach(function(input) {
            input.addEventListener('input', function() {
                const password = document.querySelector("input[name='password']").value;
                const confirmPassword = document.querySelector("input[name='password_confirmation']").value;
                if (password === confirmPassword) {
                    passwordError.textContent = "";
                } else {
                    passwordError.textContent = "Passwords do not match";
                }
            });
        });

        document.querySelector("form").addEventListener("submit", function(event) {
            const username = usernameField.value;
            const usernameRegex = /^[a-zA-Z0-9]{4,15}$/;
            const usernameError = document.querySelector("#usernameError");

            if (!usernameRegex.test(username)) {
                usernameError.textContent = "Username must be alphanumeric and between 4 to 15 characters long.";
                event.preventDefault(); // Prevent form submission
            } else {
                usernameError.textContent = ""; // Clear any previous error message
            }
        });
    });
</script>
@endsection
