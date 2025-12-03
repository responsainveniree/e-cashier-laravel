    @php
        $userCashier = \App\Models\User::where('role', 'cashier')->get();

    @endphp

    <nav class="flex flex-1 justify-end p-4">
        @auth
            @if (auth()->user()->role == 'admin')
                <a href="{{ url('/admin-dashboard') }}" wire:navigate
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @else
                <a href="{{ url('/cashier-dashboard') }}" wire:navigate
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @endif


        @endauth

        @guest
            <a href="{{ route('login') }}" wire:navigate
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white mr-4">
                Log in
            </a>

            @if (Route::has('register') && count($userCashier) <= 2)
                <a href="{{ route('register') }}" wire:navigate
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white mr-4">
                    Register
                </a>
            @endif
        @endguest
    </nav>
