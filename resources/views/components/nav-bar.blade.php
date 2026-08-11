<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        @if (Auth::check() && Auth::user()->role == 'Admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('createProduct') }}">Create Product</a>
            </li>
        @endif
      </ul>
    </div>

    <div>
      @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit" class="btn btn-primary">Logout</button>
      </form>
      @else
        <a href="{{ route('getRegister') }}"><button class="btn btn-primary">Register</button></a>
        <a href="{{ route('getLogin') }}"><button class="btn btn-primary">Login</button></a>
      @endif
    </div>
  </div>
</nav>