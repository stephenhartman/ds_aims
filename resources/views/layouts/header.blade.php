<div class="navbar navbar-default">
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
                    <img class="depaul-brand" src="{{ url('/images/logo.png') }}" height="40px">
                </span>
                <p class="navbar-brand" style="float:right; padding-left:1.5em">DePaul Alumni System</p>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav nav">
                @if (!Auth::guest())
                    @if (Auth::user()->hasRole('admin'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-secondary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::to('alumni') }}">Alumni Database</a></li>
                                <li><a href="{{ URL::to('alumni/education') }}">Education Milestones</a></li>
                                <li><a href="{{ URL::to('alumni/occupation') }}">Occupation Milestones</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="btn btn-secondary" href="{{ URL::to('posts') }}">Browse Posts</a>
                        </li>
                        <li>
                            <a class="btn btn-secondary" href="{{ URL::to('events') }}">Event Calendar</a>
                        </li>
                    @else
                        <li>
                            <a class="btn btn-secondary" href="{{ URL::to('posts') }}">Browse Posts</a>
                        </li>
                        <li>
                            <a class="btn btn-secondary" href="{{ URL::to('events') }}">Event Calendar</a>
                        </li>
                        @if (Auth::user()->alumnus !== null)
                            @if (Auth::user()->alumnus->initial_setup == 1)
                                <li>
                                    <a href="{{ route('community', array(Auth::user(), Auth::user()->alumnus)) }}" class="btn btn-secondary">Community</a>
                                </li>
                            @endif
                        @endif
                    @endif
                @endif
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('users.show', Auth::user()) }}">Edit Profile</a>
                            </li>
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
</div>
