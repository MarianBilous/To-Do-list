<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">To-Do-list</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (Route::has('login'))
            @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('tasks.index') }}">Tasks</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile-pic">
                                    {{ Auth::user()->name }}
                                </div>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-fw"></i>
                                        Log Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @else
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                        <a
                            href="{{ route('login') }}"
                            class="nav-link active"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="nav-link active"
                            >
                                Register
                            </a>
                        @endif
                    </ul>
                </div>
            @endauth
        @endif
    </div>
</nav>
