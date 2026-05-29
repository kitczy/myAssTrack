@extends('layouts.app')

@section('content')

<style>

    nav {
        display: none !important;
    }

    body {
        overflow: hidden;
    }

    .toast-container {
        z-index: 9999;
    }

</style>

{{-- SUCCESS TOAST --}}
@if(session('success'))

<div class="toast-container position-fixed top-0 end-0 p-3">

    <div id="successToast"
         class="toast text-bg-success border-0"
         role="alert">

        <div class="d-flex">

            <div class="toast-body">
                {{ session('success') }}
            </div>

            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>

        </div>

    </div>

</div>

@endif


{{-- VALIDATION ERROR TOAST --}}
@if($errors->any())

<div class="toast-container position-fixed top-0 end-0 p-3">

    <div id="errorToast"
         class="toast text-bg-danger border-0"
         role="alert">

        <div class="d-flex">

            <div class="toast-body">

                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

            <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">
            </button>

        </div>

    </div>

</div>

@endif


<div style="
    background-image: url('{{ asset('img/bluue.jpg') }}');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
" class="d-flex justify-content-center align-items-center">


    <!-- TITLE -->
    <a href="{{ route('welcome') }}"
       class="text-decoration-none position-absolute top-0 start-0 px-4 py-3 mx-3 mt-3">

        <h5 class="fw-bold text-dark">
            Study Planner
        </h5>

    </a>


    <div class="container">

        <!-- REGISTER CARD -->
        <div class="row shadow-lg rounded-4 overflow-hidden mx-auto"
             style="max-width: 900px;">

            <!-- LEFT SIDE -->
            <div class="col-md-6 p-4 d-flex align-items-center">

                <div class="w-100">

                    <p class="text-center fs-5 fw-semibold mb-4">
                        Create your account
                    </p>

                    <!-- REGISTER FORM -->
                    <form method="POST"
                          action="{{ route('register') }}">

                        @csrf

                        <!-- FULL NAME -->
                        <div class="form-floating mb-3">

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Full Name"
                                   value="{{ old('name') }}"
                                   required>

                            <label>Full Name</label>

                        </div>

                        <!-- EMAIL -->
                        <div class="form-floating mb-3">

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Email Address"
                                   value="{{ old('email') }}"
                                   required>

                            <label>Email Address</label>

                        </div>

                        <!-- PASSWORD -->
                        <div class="form-floating mb-3">

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   required>

                            <label>Password</label>

                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div class="form-floating mb-3">

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm Password"
                                   required>

                            <label>Confirm Password</label>

                        </div>

                        <!-- REGISTER BUTTON -->
                        <button type="submit"
                                class="btn btn-primary fw-bold w-100 mt-2">

                            Register

                        </button>

                        <hr>

                        <!-- LOGIN LINK -->
                        <p class="text-center mb-0">

                            Already have an account?

                            <a href="{{ route('login') }}"
                               class="text-decoration-none fw-semibold">

                                Log in

                            </a>

                        </p>

                    </form>

                </div>

            </div>

            <!-- RIGHT SIDE IMAGE -->
            <div class="col-md-6 d-none d-md-block p-0">

                <img src="{{ asset('img/bg2.jpg') }}"
                     class="w-100 h-100 object-fit-cover"
                     alt="Register Image">

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    // SUCCESS TOAST
    const successToast = document.getElementById('successToast');

    if (successToast) {

        new bootstrap.Toast(successToast, {
            delay: 4000
        }).show();

    }

    // ERROR TOAST
    const errorToast = document.getElementById('errorToast');

    if (errorToast) {

        new bootstrap.Toast(errorToast, {
            delay: 5000
        }).show();

    }

});

</script>

@endsection