<!-- Header -->
<header class="main-header " id="header">
  <nav class="navbar navbar-static-top navbar-expand-lg">
    <!-- Sidebar toggle button -->
    <!-- search form -->
    <div class="search-form d-none d-lg-inline-block">
      <div class="input-group">
      </div>
      <div id="search-results-container">
        <ul id="search-results"></ul>
      </div>
    </div>

    <div class="navbar-right ">
      <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu custom-dropdown">

          
          </button>

          <div class="card card-default dropdown-notify dropdown-menu-right mb-0">


            <div class="card-body px-0 py-3">


           
       

            <li class="dropdown-footer">
            <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>