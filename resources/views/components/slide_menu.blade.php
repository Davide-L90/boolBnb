<div class="slide_menu d_none">
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