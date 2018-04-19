<div class="navbar navbar-default">
    <div class="container-fluid">
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
                    <img class="depaul-brand" src="{{ url('/images/logo.png') }}" height="45px">
                </span>
                <p class="navbar-brand {{ Request::is('home') ? 'active' : '' }}" style="float:right;">DePaul Alumni System</p>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav nav">
                @if (!Auth::guest())
                    @if (Auth::user()->hasRole('admin'))
                        <li class="dropdown {{ Request::is('admin/*') ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ Request::is('admin/alumni') ? 'active' : '' }}"><a href="{{ URL::to('admin/alumni') }}">Alumni Database</a></li>
                                <li class="{{ Request::is('admin/alumni/education') ? 'active' : '' }}"><a href="{{ URL::to('admin/alumni/education') }}">Education Milestones</a></li>
                                <li class="{{ Request::is('admin/alumni/occupation') ? 'active' : '' }}"><a href="{{ URL::to('admin/alumni/occupation') }}">Occupation Milestones</a></li>
                                <li class="{{ Request::is('admin/roles') ? 'active' : '' }}"><a href="{{ URL::to('admin/roles') }}">User Roles</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                            <a href="{{ URL::to('posts') }}">Browse Posts</a>
                        </li>
                        <li class="{{ Request::is('events*') ? 'active' : '' }}">
                            <a href="{{ URL::to('events') }}">Event Calendar</a>
                        </li>
                        <li class="{{ Request::is('photos*') ? 'active' : '' }}">
                            <a href="{{ URL::to('photos') }}">Photo Gallery</a>
                        </li>
                        <li class="{{ Request::is('community') ? 'active' : '' }}">
                            <a href="{{ route('home.community') }}">Community</a>
                        </li>
                    @else
                        <li class="{{ Request::is('posts*') ? 'active' : '' }}">
                            <a href="{{ URL::to('posts') }}">Browse Posts</a>
                        </li>
                        <li class="{{ Request::is('events*') ? 'active' : '' }}">
                            <a href="{{ URL::to('events') }}">Event Calendar</a>
                        </li>
                        <li class="{{ Request::is('photos*') ? 'active' : '' }}">
                            <a href="{{ URL::to('photos') }}">Photo Gallery</a>
                        </li>
                        @if (Auth::user()->alumnus !== null)
                            @if (Auth::user()->alumnus->initial_setup == 1)
                                <li class="{{ Request::is('users/*/alumni/*/community') ? 'active' : '' }}">
                                    <a href="{{ route('community', array(Auth::user(), Auth::user()->alumnus)) }}">Community</a>
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
                    <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
                    <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown {{ Request::is('users/*') ? 'active' : '' }}"">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="{{ Request::is('users/*') ? 'active' : '' }}">
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
