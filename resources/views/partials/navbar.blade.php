<nav class="navbar navbar-expand-lg bg-white bg-opacity-75 shadow-sm rounded-4 px-4 py-2 mx-3 mt-3">
  <div class="container-fluid">
    
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      Study Planner
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center gap-3">

        <li class="nav-item">
          <a class="nav-link fw-medium" href="{{ url('/') }}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link fw-medium" href="{{ route('about') }}">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link fw-medium" href="{{ route('contact') }}">Contact</a>
        </li>

        @guest
        <li class="nav-item">
            <a href="{{ route('login') }}"
                class="btn btn-outline-primary rounded-3 px-4 fw-medium">
                Login
            </a>
        </li>
        @endguest

        @auth
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link fw-medium btn btn-link p-0">Logout</button>
          </form>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>