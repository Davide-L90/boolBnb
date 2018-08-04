<nav class="">
    <div class="heading">
        <a href="{{ route('welcome') }}">BoolBnb</a>
    </div>
    <div class="auth_cnt">
        <div id="hamburger_icon" class="hamburger_menu">
            <i class="fas fa-2x fa-bars"></i>
            @include('components.slide_menu')
        </div>
        <div class="menu_items">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('home') }}">Profile</a>
                    <a href="{{ route('inbox.show') }}">Inbox</a>  
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            @endif
        </div>
    </div>
</nav>