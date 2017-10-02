<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="pull-left" href="{{ url('/home') }}">
                <span>
                    <img class="depaul-brand" src="http://mediaprocessor.websimages.com/fit/1920x1920/www.depaulschool.com/Large DePaul Lion Head Silhouette Facing Right.png" height="40px">
                </span>
                <p class="navbar-brand">DePaul Alumni System</p>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav nav">
            @if (!Auth::guest())
                @if (Auth::user()->is_admin)
                    <li>
                        <a class="btn btn-secondary" href="{{ URL::to('users') }}">Search Students</a>
                    </li>
                    <li>
                        <a class="btn btn-secondary" href="{{ URL::to('posts') }}">Search Posts</a>
                    </li>
                    <li>
                        <a class="btn btn-secondary" href="{{ URL::to('events') }}">Search Events</a>
                    </li>
                @else
                    <li>
                        <a class="btn btn-secondary" href="{{ URL::to('#') }}">Edit Your Information</a>
                    </li>
                @endif
            @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
