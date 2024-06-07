<!-- <div class="fixed-top">
    <div class="logo-header ">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                    <div class="logo mr-xs-3">
                        <img src="{{ asset('assets/img/clsu-logo.png') }}" alt="">
                    </div>
                    <div class="logo-text m-xs-0">
                        <span class="logo-title">Office of Student Affairs</span>
                        <span class="logo-sub">Central Luzon State University</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid navi-section">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('welcome') }}" active>HOME</a>
            </li>
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('about_us') }}">ABOUT US</a>
            </li>
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('impu') }}">IMPU</a>
            </li>
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('cdesu') }}">CDESU</a>
            </li>
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('gsu') }}">GSU</a>
            </li>
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('sou') }}">SOU</a>
            </li>
            <li class="nav-item me-2">
              <a class="nav-link text-white" href="{{ route('sdb') }}">SDB</a>
            </li>
            @if (auth()->check() && auth()->user()->role == 1)
            <li class="nav-item me-2">
              <a href="archive/" class="nav-link text-white">
                ARCHIVES
              </a>
            </li>
            <li class="nav-item me-2">
              <a href="#" class="nav-link text-white dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
                COMPLAINS &nbsp;
                @if ($totalUnsent > 0)
                <span class="red-dot"><i class="fa-solid fa-bell" style="animation: sway 1s infinite;"></i></span>
                @endif
              </a>
              <ul class="dropdown-menu">
                <li>
                  <form action="{{ route('recent_complaints') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item rounded-5">RECENT COMPLAINTS</button>
                  </form>
                </li>
                <li>
                  <form action="{{ route('replied_complaints') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item rounded-5">REPLIED COMPLAINTS</button>
                  </form>
                </li>
              </ul>
            </li>
            @endif
          </ul>
        </div>
        <div class="d-flex align-items-center">
          @auth
          @if (auth()->user()->role == 1 || auth()->user()->role == 0)
          @if (auth()->user()->role == 0)
          @php
          $role = "Student";
          @endphp
          @elseif (auth()->user()->role == 1)
          @php
          $role = "Admin";
          @endphp
          @endif

          <li class="nav-item-out">
            <span class="nav-link text-white"></span>
          </li>
          <li class="nav-item-out">
            <div class="btn-group shadow-0">
              <a type="button" class="link text-white ps-3 dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->fullname }} | {{ $role }}
              </a>
              <ul class="dropdown-menu">
                <li>
                  <form action="{{ route('manage_profile') }}" method="POST">
                    @csrf
                    <button class="dropdown-item rounded-5" type="submit">Profile</button>
                  </form>
                </li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item rounded-5" type="submit">Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          </li>
          @endif
          @else
          <li class="nav-item-out">
            <div class="btn-group shadow-0">
              <a type="button" class="link text-white ps-3" data-mdb-toggle="modal" data-mdb-target="#login_Modal">
                Login / Register
              </a>
            </div>
          </li>
          @endauth
        </div>
      </div>
    </nav>
</div> -->

<div class="fixed-top">
  <div class="logo-header ">
    <div class="container-fluid">
      <div class="row d-flex justify-content-between">
        <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
          <div class="logo mr-xs-3">
            <img src="{{ asset('assets/img/clsu-logo.png') }}" alt="CLSU_LOGO">
          </div>
          <div class="logo-text m-xs-0">
            <span class="logo-title">Office of Student Affairs</span>
            <span class="logo-sub">Central Luzon State University</span>
            <!-- <span class="logo-sub">Science City of Muñoz, Nueva Ecija, Philippines, 3120</span> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid navi-section">
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('welcome') }}" active>HOME</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('about_us') }}">ABOUT US</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('impu') }}">IMPU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('cdesu') }}">CDESU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('gsu') }}">GSU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('sou') }}">SOU</a>
          </li>
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('sdb') }}">SDB</a>
          </li>
          @auth
          @if(Auth::user()->userType == 'Admin')
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('archives.index') }}">ARCHIVES</a>
          </li>
          <li class="nav-item me-2">
            <a type="button" class="nav-link text-white dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
              COMPLAINS &nbsp;
              <span class="red-dot"><i class="fa-solid fa-bell" style="animation: sway 1s infinite;"></i></span>
            </a>
            <ul class="dropdown-menu">
              <form action="{{ route('complaints.index') }}" method="GET">
                <li>
                  <button type="submit" class="dropdown-item rounded-5">RECENT COMPLAINTS</button>
                </li>
              </form>
              <form action="{{ route('complaints.previous') }}" method="GET">
                <li>
                  <button type="submit" class="dropdown-item rounded-5">REPLIED COMPLAINTS</button>
                </li>
              </form>
            </ul>
          </li>
          @endif
          @endauth
        </ul>
      </div>
      <div class="d-flex align-items-center">
        @auth
        <li class="nav-item-out">
          <div class="btn-group shadow-0">
            <a type="button" class="link text-white ps-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->fullname }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!-- <li>
                <form action="{{ route('manage-profile') }}" method="GET">
                  @csrf
                  <button class="dropdown-item rounded-5" type="submit">Profile</button>
                </form>
              </li> -->
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="dropdown-item rounded-5" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </li>
        @else
        <li class="nav-item-out">
          <div class="btn-group shadow-0">
            <a type="button" class="link text-white ps-3" href="{{ route('login') }}">
              Login
            </a>
          </div>
        </li>
        @endauth
      </div>
    </div>
  </nav>
</div>

<!-- Modal Login-->
<div class="modal fade" id="login_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="justify-content-center d-flex" style="height: 50px;">
          <img src="{{ asset('assets/img/logo.png') }}" alt="login-logo" class="shadow rounded-circle">
        </div>
        <div class="py-2 justify-content-center d-flex">
          <h5>CLSU Account for OSA</h5>
        </div>
        <div class="text-center">
          <p>Log in with the credentials of your account to get more accurate view of office of student affairs.</p>
        </div>
        <form method="POST">
          <!-- Email input -->
          <div class="form-outline mb-3 mt-4">
            <input type="email" id="email" name="email" class="form-control" required />
            <label class="form-label" for="email">Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-2">
            <input type="password" id="password" name="password" class="form-control" required />
            <label class="form-label" for="password">Password</label>
          </div>
          <div class="mb-4 justify-content-end d-flex">
            <a href="../forgot_pw/" class="text-muted">Forgot password?</a>
          </div>
          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-dark btn-block shadow-0">Continue</button>
          <div class="pt-3 text-center">
            Don't have an account? <a href="../register.php" class="text-success">Register Here</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>