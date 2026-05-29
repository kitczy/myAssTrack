@extends('layouts.app')

@section('content')

<style>

.hero-section {
    padding: 90px 0;
}

.hero-title {
    font-size: 52px;
    font-weight: 800;
    line-height: 1.15;
    color: #0d1b2a;
    margin-bottom: 18px;
}

.hero-text {
    font-size: 17px;
    color: #6c757d;
    line-height: 1.75;
}

.hero-image {
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .10);
    width: 80%;
    object-fit: cover;
}

.feature-card {
    border: 1px solid #e9ecef;
    border-radius: 20px;
    overflow: hidden;
    transition: transform .25s, box-shadow .25s;
    background: #fff;
}

.feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 28px rgba(13, 110, 253, .12);
}

.feature-card img {
    height: 400px;
    object-fit: cover;
    width: 100%;
}

.feature-card .card-body {
    padding: 22px 20px;
}

.feature-title {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 6px;
    color: #0d1b2a;
}

.cta-box {
    background: #0a2a4a;
    border-radius: 24px;
    padding: 48px 44px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
}

.cta-box h2 {
    font-size: 26px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 8px;
}

.cta-box p {
    font-size: 15px;
    color: #90b8d8;
    margin: 0;
    max-width: 400px;
    line-height: 1.65;
}

.cta-box .btn-cta {
    background: #fff;
    color: #0a2a4a;
    font-weight: 700;
    font-size: 15px;
    padding: 13px 30px;
    border-radius: 12px;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: background .15s;
}

.cta-box .btn-cta:hover {
    background: #dbeafe;
    color: #0a2a4a;
}

</style>

<!-- Hero -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- Left -->
            <div class="col-lg-6">

                <h2 class="hero-title">
                    Plan Smarter.<br>
                    Study Better.<br>
                    Achieve More.
                </h2>

                <p class="hero-text">
                    Study Planner helps students organize assignments,
                    manage deadlines, and improve productivity with a
                    simple and modern planner system.
                </p>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}"
                       class="btn btn-primary btn-lg px-4 rounded-5">
                        Get Started
                    </a>
                    <a href="{{ route('about') }}"
                       class="btn btn-outline-secondary btn-lg px-4 rounded-5">
                        Learn More
                    </a>
                </div>
            </div>

            <!-- Right -->
            <div class="col-lg-6 text-center">
                <img src="{{ asset('img/bg1.png') }}"
                     alt="Study Planner"
                     class="img-fluid hero-image">
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2" style="font-size:28px;">
                Why Students Love Study Planner
            </h2>
            <p class="text-muted">
                Everything you need to stay productive and organized.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <img src="{{ asset('img/sched.png') }}"
                         alt="Scheduling">
                    <div class="card-body">
                        <h5 class="feature-title">
                            Scheduling
                        </h5>
                        <p class="text-muted mb-0" style="font-size:14px;">
                            Organize classes, activities,
                            and assignments in one place.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <img src="{{ asset('img/dr.jpg') }}"
                         alt="Deadline Reminders">
                    <div class="card-body">
                        <h5 class="feature-title">
                            Deadline Reminders
                        </h5>
                        <p class="text-muted mb-0" style="font-size:14px;">
                            Never miss important submissions
                            with timely reminders.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <img src="{{ asset('img/spt.jpg') }}"
                         alt="Study Tracking">
                    <div class="card-body">
                        <h5 class="feature-title">
                            Study Tracking
                        </h5>
                        <p class="text-muted mb-0" style="font-size:14px;">
                            Monitor progress and improve
                            your daily study habits.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <div class="cta-box">
            <div>
                <h2>
                    Ready to stop cramming?
                </h2>
                <p>
                    Join thousands of students already planning smarter
                    and hitting every deadline.
                </p>
            </div>
            <a href="{{ route('register') }}"
               class="btn-cta">
                Create free account
            </a>
        </div>
    </div>
</section>

@include('layouts.footer')

@endsection