@extends('layouts.app')

@section('content')

<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-5">Contact Us</h2>
    <div class="row justify-content-center align-items-stretch g-4">
      <div class="col-md-5">
        <div class="card shadow-lg rounded-4 p-4 h-100 border-0" style="background-color: transparent;">
          <h4 class="text-center mb-4">Send a Message</h4>
          <form method="POST" action="{{ route('contact.send') }}">
              @csrf
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
              <label for="name">Name</label>
            </div>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
              <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
              <textarea class="form-control" id="message" name="message" placeholder="Type your message" style="height: 120px"></textarea>
              <label for="message">Message</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
              Send Message
            </button>
          </form>
        </div>
      </div>

      <div class="col-md-5">
        <div class="card shadow-lg rounded-4 h-100 border-0 overflow-hidden">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.9045269309813!2d121.06212397575416!3d14.316978083956311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d771a8ee1419%3A0x8ba33fccb95a7b40!2sCavite%20State%20University%20-%20Carmona!5e0!3m2!1sen!2sph!4v1771073724102!5m2!1sen!2sph"
            width="100%" height="100%" style="border:0; min-height:420px;" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>

@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToastSuccess" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {
    const successToastEl = document.getElementById('liveToastSuccess');
    if (successToastEl) {
        const toast = new bootstrap.Toast(successToastEl, {
            delay: 5000
        });
        toast.show();
    }
});
</script>

<!-- Footer -->
@include('layouts.footer')

@endsection