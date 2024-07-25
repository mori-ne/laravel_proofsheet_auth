<aside class="flex flex-col shrink-0 bg-white p-6 w-64 border-neutral-300 border-r">
    <!-- Logo -->
    <div class="shrink-0 flex items-center text-xl font-extrabold mb-8">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>

    {{-- メインメニュー --}}
    <div class="mb-8">
        <h3 class="font-bold text-sm mb-3">メインメニュー</h3>
        <ul>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-package-bold"></i>
                    <a class="block text-gray-500" href="{{ route('dashboard') }}">ダッシュボード</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 管理項目 --}}
    <div class="mb-8">
        <h3 class="font-bold text-sm mb-3">管理項目</h3>
        <ul>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-box-filing-bold"></i>
                    <a class="block text-gray-500" href="{{ route('projects.index') }}">プロジェクト管理</a>
                </div>
            </li>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-plus-clipboard-bold"></i>
                    <a class="block text-gray-500" href="{{ route('forms.index') }}">フォーム管理</a>
                </div>
            </li>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-envelope-bold"></i>
                    <a class="block text-gray-300" href="#">メール管理</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 作成項目 --}}
    <div class="mb-8">
        <h3 class="font-bold text-sm mb-3">作成項目</h3>
        <ul>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-plus-circle"></i> <a class="block text-gray-500"
                        href="{{ route('projects.create') }}">プロジェクト作成</a>
                </div>
            </li>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-plus-circle"></i> <a class="block text-gray-500"
                        href="{{ route('forms.create') }}">フォーム作成</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 投稿者項目 --}}
    <div class="mb-8">
        <h3 class="font-bold text-sm mb-3">投稿者項目</h3>
        <ul>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-list-bold"></i>
                    <a class="block text-gray-300" href="#">投稿一覧</a>
                </div>
            </li>
            <li class="mb-2">
                <div class="flex items-center gap-3">
                    <i class="at-account-bold"></i>
                    <a class="block text-gray-300" href="#">アカウント管理</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- account --}}
    <nav x-data="{ open: false }" class="bg-white border-neutral-300">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6 lg:px-6">
            <div class="flex justify-center h-16">

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-neutral-300">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>


</aside>
