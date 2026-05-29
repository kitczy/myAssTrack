@extends('layouts.app')

@section('content')

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">About Study Planner</h2>
      <p class="text-muted">
         Study Planner is a productivity tool created to help students manage their
         time more effectively and stay organized throughout their academic journey.
         It provides a simple and structured way to plan schedules, track study
         sessions, and monitor important deadlines in one convenient place. By
         combining planning, reminders, and progress tracking, Study Planner helps
         students reduce stress, avoid procrastination, and build consistent study
         habits. The goal is to support learners in staying focused, improving
         productivity, and achieving academic success while maintaining a balanced
         and less overwhelming study routine.
      </p>
    </div>

    <div class="row align-items-center mb-5 g-4">
      <div class="col-md-5">
        <div class="card shadow rounded-4">
          <img src="{{ asset('img/sched.png') }}" class="card-img-top rounded-4">
        </div>
      </div>
      <div class="col-md-7">
        <h4 class="fw-bold">Scheduling</h4>
        <p class="text-muted">
          Study Planner helps students organize their academic life by allowing
          them to schedule classes, assignments, and study sessions in one place.
          Instead of relying on memory or scattered notes, students can clearly
          see their daily and weekly plans, making time management easier and
          more effective.
        </p>
      </div>
    </div>

    <div class="row align-items-center mb-5 g-4 flex-md-row-reverse">
      <div class="col-md-5">
        <div class="card shadow rounded-4">
          <img src="{{ asset('img/dr.jpg') }}" class="card-img-top rounded-4">
        </div>
      </div>
      <div class="col-md-7">
        <h4 class="fw-bold">Deadline Reminders</h4>
        <p class="text-muted">
          Missing deadlines can affect academic performance. Study Planner
          provides reminder features that notify students about upcoming tasks
          and submissions. This helps reduce procrastination and ensures that
          important responsibilities are completed on time.
        </p>
      </div>
    </div>

    <div class="row align-items-center g-4">
      <div class="col-md-5">
        <div class="card shadow rounded-4">
          <img src="{{ asset('img/spt.jpg') }}" class="card-img-top rounded-4">
        </div>
      </div>
      <div class="col-md-7">
        <h4 class="fw-bold">Study Tracking</h4>
        <p class="text-muted">
          Study Planner allows students to monitor their productivity and study
          habits over time. By tracking completed tasks and study sessions,
          users gain insights into their learning patterns and can improve their
          focus, discipline, and academic performance.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
@include('layouts.footer')

@endsection