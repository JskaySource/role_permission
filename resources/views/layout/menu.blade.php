 <!-- navber -->
 <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary"> 
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Role Permission</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/"> Home</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Registration</a>
        </li>
      </ul>
    </div>
  </div>
</nav>