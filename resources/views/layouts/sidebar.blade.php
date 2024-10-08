<aside class="h-svh flex w-64 shrink-0 flex-col overflow-y-scroll border-0 border-neutral-300 bg-white px-3 py-6 shadow-md shadow-neutral-200">

    <!-- Logo -->
    <div class="mb-8 ml-4 flex shrink-0 items-center text-xl font-extrabold">
        <a href="{{ route('dashboard') }}">
            <p class="block h-9 w-auto fill-current text-neutral-800">Proofsheet</p>
        </a>
    </div>

    {{-- mainmenu --}}
    <div class="mb-8">
        <h3 class="mb-2 ml-4 text-sm font-bold">メインメニュー</h3>
        <ul>
            <li class="rounded-md bg-white px-4 py-1.5 transition-all hover:bg-neutral-200">
                <div class="flex items-center gap-3">
                    <i class="at-package-bold"></i>
                    <a class="block text-neutral-500" href="{{ route('dashboard') }}">ダッシュボード</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- 管理項目 --}}
    <div class="mb-8">
        <h3 class="mb-2 ml-4 text-sm font-bold">管理・作成項目</h3>
        <ul>
            <li class="rounded-md bg-white px-4 py-1.5 transition-all hover:bg-neutral-200">
                <div class="flex items-center gap-3">
                    <i class="at-box-filing-bold"></i>
                    <a class="block text-neutral-500" href="{{ route('projects.index') }}">プロジェクト管理</a>
                </div>
            </li>
            <li class="rounded-md bg-white px-4 py-1.5 transition-all hover:bg-neutral-200">
                <div class="flex items-center gap-3">
                    <i class="at-plus-circle"></i> <a class="block text-neutral-500" href="{{ route('projects.create') }}">プロジェクト作成</a>
                </div>
            </li>
            <li class="rounded-md bg-white px-4 py-1.5 transition-all hover:bg-neutral-200">
                <div class="flex items-center gap-3">
                    <i class="at-plus-circle"></i> <a class="block text-neutral-500" href="{{ route('forms.create') }}">フォーム作成</a>
                </div>
            </li>
            {{-- <li class="rounded-md bg-white px-4 py-1.5 transition-all hover:bg-neutral-200">
                <div class="flex items-center gap-3">
                    <i class="at-plus-clipboard-bold"></i>
                    <a class="block text-neutral-500" href="{{ route('forms.index') }}">フォーム管理</a>
                </div>
            </li> --}}
        </ul>
    </div>

    {{-- 投稿者項目 --}}
    <div class="mb-8">
        <h3 class="mb-2 ml-4 text-sm font-bold text-neutral-300">投稿者項目</h3>
        <ul>
            <li class="pointer-events-none rounded-md bg-white px-4 py-1.5 transition-all">
                <div class="flex items-center gap-3">
                    <i class="at-list-bold text-neutral-300"></i>
                    <a class="block text-neutral-300" href="#">投稿一覧</a>
                </div>
            </li>
            <li class="pointer-events-none rounded-md bg-white px-4 py-1.5 transition-all">
                <div class="flex items-center gap-3">
                    <i class="at-account-bold text-neutral-300"></i>
                    <a class="block text-neutral-300" href="#">アカウント管理</a>
                </div>
            </li>
            <li class="pointer-events-none rounded-md bg-white px-4 py-1.5 transition-all">
                <div class="flex items-center gap-3">
                    <i class="at-envelope-bold text-neutral-300"></i>
                    <a class="block text-neutral-300" href="#">メール管理</a>
                </div>
            </li>
        </ul>
    </div>

    {{-- アカウント --}}
    <nav class="mb-8 mt-auto">
        <div class="flex flex-col">
            <p class="text-md mb-2 ml-4 font-bold">{{ Auth::user()->name }}&nbsp;<span class="text-sm font-normal">さん</span></p>
            <a class="rounded-md px-4 py-1.5 text-sm text-neutral-500 transition-all hover:bg-neutral-100" href="{{ route('profile.edit') }}">アカウント</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full rounded-md px-4 py-1.5 text-left text-sm text-red-500 transition-all hover:bg-red-100" type="submit">ログアウト</button>
            </form>
        </div>
    </nav>

</aside>
