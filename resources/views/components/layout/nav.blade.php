<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">

        <div>
            <a href="/" class="font-semibold">Idea</a>
        </div>

        <div class="flex items-center gap-x-5">

            {{-- Gość --}}
            @guest
                <a href="{{ route('login') }}">Sign In</a>

                <a href="{{ route('register') }}" class="btn">
                    Register
                </a>
            @endguest


            {{-- Zalogowany --}}
            @auth
                <span class="text-sm text-muted-foreground">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-outlined border-error text-error">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
