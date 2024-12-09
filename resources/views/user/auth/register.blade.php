@extends('user.auth.master')

@section('auth-content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-6 align-self-center">
        <a href="../../dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3 justify-content-center text-primary">
            <div class="logo-normal">
                <svg viewBox="0 0 32 32" width="80px" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25333 2H22.0444L29.7244 15.2103L22.0444 28.1333H7.25333L0 15.2103L7.25333 2ZM11.2356 9.32316H18.0622L21.3334 15.2103L18.0622 20.9539H11.2356L8.10669 15.2103L11.2356 9.32316Z" fill="currentColor"/>
                    <path d="M23.751 30L13.2266 15.2103H21.4755L31.9999 30H23.751Z" fill="#3FF0B9"/>
                </svg>
            </div>
            <h2 class="logo-title ms-3 mb-0" data-setting="app_name">Qompac UI</h2>
        </a>
    </div>
    <div class="col-md-9">
        <div class="card auth-card d-flex justify-content-center mb-0">
            <div class="card-body">
                <h2 class="mb-2 text-center">Sign Up</h2>
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
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="fa-solid fa-eye-slash fs-2"></i>
                                    <i class="fa-solid fa-eye fs-2 d-none"></i>
                                </span>
                                @error('password')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Repeat Password" />
                                <span class="eyeabsolute cursor-pointer" onclick="toggleVisibility()">
                                    <i id="closeeye" class="fa-solid fa-eye-slash fs-2"></i>
                                    <i id="openeye" class="fa-solid fa-eye fs-2 hidden"></i>
                                </span>
                                <span id="passwordError" class="text-danger"></span>
                                @error('password_confirmation')
                                    <div class="alert text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </div>
                    <p class="text-center my-3">or sign in with other accounts?</p>
                    <p class="mt-3 text-center">Already have an account? <a href="{{ route('login') }}" class="text-underline">Sign In</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
