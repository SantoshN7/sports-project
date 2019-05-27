<header class="site-header">
  <nav class="navbar navbar-expand-md navbar-dark bg-steel fixed-top affix">
    <div class="container">
     <a class="navbar-brand" href="/">Sports</a>
     <button type="button"  class="navbar-toggler" data-toggle="collapse" data-target="#collapsibleNavbar">
     <span class="navbar-toggler-icon"></span>
     </button>
  </div>
    <!--left side-->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
        <li><a class="nav-item nav-link" href="/">Home</a></li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-item nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Sports<span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/players">
              Players
            </a>
            <a class="dropdown-item" href="/teams">
              Teams
            </a>
          </div>
        </li>
        @if(Auth::check())
          <li><a class="nav-item nav-link" href="/team">Team</a></li>
          @else
        @endif
        <li><a class="nav-item nav-link" href="/tournament">Tournament</a></li>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/dashboard">
                    Profile
                  </a>
                  <a class="dropdown-item" href="/notifications">
                    Notifications
                  </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
  </div>
  </div>
  </nav>
  </header>
