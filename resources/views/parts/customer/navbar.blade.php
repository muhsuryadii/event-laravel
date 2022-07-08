<nav class="navbar navbar-expand-lg bg-white shadow-md sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src=" {{ asset('image/logo_usni.png') }}" alt="logo"
                class="block mx-auto w-14 h-14  object-contain ">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-end" id="navbarNavDropdown">
            <ul class="navbar-nav text-xl">
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('/') ? 'active' : ' ' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item  ">
                    <a class="nav-link {{ (Request::is('event') ? 'active' : Request::is('event/*')) ? 'active' : ' ' }}"
                        href="{{ route('event_index') }}">Event</a>
                </li>

                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle capitalize" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hi,

                            @if (str_word_count(Auth::user()->nama_user) === 0)
                                {{ Auth::user()->nama_user }}
                            @else
                                {{ explode(' ', Auth::user()->nama_user)[0] }}
                            @endif

                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile_show', Auth::user()->uuid) }}">
                                    <i class="bi bi-person text-xl text-slate-600 mr-3"></i>
                                    Profil
                                </a>
                            </li>


                            <li>
                                <a class="dropdown-item " href="/transaksi">
                                    <i class="bi bi-receipt text-xl text-slate-600 mr-3 active:!text-white"></i>
                                    Transaksi
                                </a>

                            </li>
                            <li class='active:text-white'>
                                <a class="dropdown-item " href="/my-events">
                                    <i class="bi bi-ticket-perforated text-xl text-slate-600 mr-3 "></i>
                                    My Events
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <div class="dropdown-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                                            onclick="event.preventDefault();this.closest('form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link px-2 rounded-xl  border border-slate-600 mx-3 hover:text-white hover:bg-slate-200"
                            href="/register ">Register
                        </a>

                    </li>
                    <li class="nav-item ">
                        <a class="nav-link px-3 py-2 rounded-xl shadow-md bg-indigo-500 hover:bg-indigo-600 text-white"
                            href="/login">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
