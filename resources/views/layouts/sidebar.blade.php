<aside class="h-svh flex w-64 shrink-0 flex-col overflow-y-scroll border-r border-neutral-300 bg-white p-6">

    <!-- Logo -->
    <div class="mb-8 flex shrink-0 items-center text-xl font-extrabold">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
    </div>

    {{-- mainmenu --}}
    <div class="mb-8">
        <h3 class="mb-3 text-sm font-bold">メインメニュー</h3>
        <ul>
            <li class="rounded-md bg-white px-2 py-1 transition hover:bg-gray-100">
                <div class="flex items-center gap-3">
                    <i class="at-package-bold"></i>
                    <a class="block text-gray-500" href="{{ route('dashboard') }}">ダッシュボード</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 管理項目 --}}
    <div class="mb-8">
        <h3 class="mb-3 text-sm font-bold">管理項目</h3>
        <ul>
            <li class="rounded-md bg-white px-2 py-1 transition hover:bg-gray-100">
                <div class="flex items-center gap-3">
                    <i class="at-box-filing-bold"></i>
                    <a class="block text-gray-500" href="{{ route('projects.index') }}">プロジェクト管理</a>
                </div>
            </li>
            <li class="rounded-md bg-white px-2 py-1 transition hover:bg-gray-100">
                <div class="flex items-center gap-3">
                    <i class="at-plus-clipboard-bold"></i>
                    <a class="block text-gray-500" href="{{ route('forms.index') }}">フォーム管理</a>
                </div>
            </li>
            <li class="pointer-events-none rounded-md bg-white px-2 py-1 transition">
                <div class="flex items-center gap-3">
                    <i class="at-envelope-bold text-gray-300"></i>
                    <a class="block text-gray-300" href="#">メール管理</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 作成項目 --}}
    <div class="mb-8">
        <h3 class="mb-3 text-sm font-bold">作成項目</h3>
        <ul>
            <li class="rounded-md bg-white px-2 py-1 transition hover:bg-gray-100">
                <div class="flex items-center gap-3">
                    <i class="at-plus-circle"></i> <a class="block text-gray-500" href="{{ route('projects.create') }}">プロジェクト作成</a>
                </div>
            </li>
            <li class="rounded-md bg-white px-2 py-1 transition hover:bg-gray-100">
                <div class="flex items-center gap-3">
                    <i class="at-plus-circle"></i> <a class="block text-gray-500" href="{{ route('forms.create') }}">フォーム作成</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 投稿者項目 --}}
    <div class="mb-8">
        <h3 class="mb-3 text-sm font-bold">投稿者項目</h3>
        <ul>
            <li class="pointer-events-none rounded-md bg-white px-2 py-1 transition">
                <div class="flex items-center gap-3">
                    <i class="at-list-bold text-gray-300"></i>
                    <a class="block text-gray-300" href="#">投稿一覧</a>
                </div>
            </li>
            <li class="pointer-events-none rounded-md bg-white px-2 py-1 transition">
                <div class="flex items-center gap-3">
                    <i class="at-account-bold text-gray-300"></i>
                    <a class="block text-gray-300" href="#">アカウント管理</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- アカウント --}}
    <nav class="mt-auto">
        <div class="flex flex-col">
            <p class="text-md mb-2 font-bold">{{ Auth::user()->name }}&nbsp;<span class="text-sm font-normal">さん</span></p>
            <a class="rounded-md px-2 py-1 text-sm text-gray-500 transition hover:bg-gray-100" href="{{ route('profile.edit') }}">アカウント</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full rounded-md px-2 py-1 text-left text-sm text-red-500 transition hover:bg-red-100" type="submit">ログアウト</button>
            </form>
        </div>
    </nav>

</aside>
