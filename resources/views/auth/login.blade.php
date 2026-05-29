@extends('layouts.app')

@section('content')

<style>
    nav {
        display: none !important;
    }
</style>

<div style="
    background-image: url('{{ asset('img/bluue.jpg') }}');
    background-size: cover;
    background-position: center;
    height: 100vh;
" class="d-flex justify-content-center align-items-center">

    <!-- TITLE -->
    <a href="{{ route('welcome') }}"
       class="text-decoration-none position-absolute top-0 start-0 px-4 py-3 mx-3 mt-3">

        <h5 class="fw-bold text-dark">
            Study Planner
        </h5>

    </a>

    <!-- SUCCESS TOAST -->
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

    <!-- ERROR TOAST -->
    @if(session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">

        <div id="errorToast"
             class="toast text-bg-danger border-0"
             role="alert">

            <div class="d-flex">

                <div class="toast-body">
                    {{ session('error') }}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                </button>

            </div>

        </div>

    </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center">

        <div class="row shadow-lg rounded-4 overflow-hidden w-100"
             style="max-width: 900px;">

            <!-- LEFT SIDE -->
            <div class="col-md-6 p-4 d-flex align-items-center">

                <div class="w-100">

                    <p class="text-center mt-2 fs-5 fw-semibold">
                        Log in to Study Planner
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- EMAIL -->
                        <div class="form-floating mb-3">

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Email"
                                   required>

                            <label>Email address</label>

                        </div>

                        <!-- PASSWORD -->
                        <div class="form-floating mb-2">

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   required>

                            <label>Password</label>

                        </div>

                        <!-- REMEMBER -->
                        <div class="form-check mt-2">

                            <input class="form-check-input"
                                   type="checkbox"
                                   name="remember">

                            <label class="form-check-label">
                                Remember email address
                            </label>

                        </div>

                        <!-- LOGIN BUTTON -->
                        <button type="submit"
                                class="btn btn-primary fw-bold mt-4 w-100">

                            Log in

                        </button>

                        <a href="#"
                           class="text-center mt-3 text-decoration-none d-block">

                            Forgot password?

                        </a>

                        <hr>

                        <p class="text-center">

                            Not a Study Planner member?

                            <a class="text-decoration-none fw-semibold"
                               href="{{ route('register') }}">

                                Register

                            </a>

                        </p>

                    </form>

                </div>

            </div>

            <!-- RIGHT IMAGE -->
            <div class="col-md-6 d-none d-md-block p-0">

                <img src="{{ asset('img/bg2.jpg') }}"
                     class="w-100 h-100 object-fit-cover">

            </div>

        </div>

    </div>

</div>

<!-- TOAST SCRIPT -->
<script>

document.addEventListener("DOMContentLoaded", function () {

    // SUCCESS
    const successToast = document.getElementById('successToast');

    if (successToast) {

        new bootstrap.Toast(successToast, {
            delay: 4000
        }).show();

    }

    // ERROR
    const errorToast = document.getElementById('errorToast');

    if (errorToast) {

        new bootstrap.Toast(errorToast, {
            delay: 5000
        }).show();

    }

});

</script>

@endsection