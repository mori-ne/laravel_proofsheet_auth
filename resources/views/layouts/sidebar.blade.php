<aside class="relative z-40 flex h-[calc(100svh_-_56px)] w-60 shrink-0 flex-col overflow-y-scroll border-0 border-r border-neutral-200 bg-white pt-8">

    {{-- mainmenu --}}
    <div class="mb-6">
        <h3 class="mb-2 ml-8 text-sm font-bold">メインメニュー</h3>
        <ul>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="{{ route('dashboard') }}">
                    <div class="flex items-center gap-2">
                        <i class="at-package-bold"></i>
                        <p class="text-neutral-500">
                            ホーム
                        </p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    {{-- manage --}}
    <div class="mb-6">
        <h3 class="mb-2 ml-8 text-sm font-bold">管理・作成項目</h3>
        <ul>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="{{ route('projects.index') }}">
                    <div class="flex items-center gap-2">
                        <i class="at-box-filing-bold"></i>
                        <p class="text-neutral-500">
                            プロジェクト管理
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="{{ route('projects.create') }}">
                    <div class="flex items-center gap-2">
                        <i class="at-plus-circle"></i>
                        <p class="text-neutral-500">
                            プロジェクト作成
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="{{ route('forms.create') }}">
                    <div class="flex items-center gap-2">
                        <i class="at-plus-circle"></i>
                        <p class="text-neutral-500">
                            フォーム作成
                        </p>
                    </div>
                </a>
            </li>
            {{-- <li class=" bg-white px-8 py-2  ">
                <div class="flex items-center gap-2">
                    <i class="at-plus-clipboard-bold"></i>
                    <a class="block text-neutral-500 hover:bg-neutral-100 transition-all" href="{{ route('forms.index') }}">フォーム管理</a>
                </div>
            </li> --}}
        </ul>
    </div>

    {{-- postuser --}}
    <div class="mb-6">
        <h3 class="mb-2 ml-8 text-sm font-bold">投稿者項目</h3>
        <ul>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="#">
                    <div class="flex items-center gap-2">
                        <i class="at-list-bold text-neutral-300"></i>
                        <p class="text-neutral-200">
                            投稿一覧
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="#">
                    <div class="flex items-center gap-2">
                        <i class="at-account-bold text-neutral-300"></i>
                        <p class="text-neutral-200">
                            アカウント管理
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a class="block px-8 py-1.5 transition-all hover:bg-neutral-100" href="#">
                    <div class="flex items-center gap-2">
                        <i class="at-envelope-bold text-neutral-300"></i>
                        <p class="text-neutral-200">
                            メール管理
                        </p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    {{-- account --}}
    <nav class="mb-6 mt-auto">
        <div class="flex flex-col">
            {{-- name --}}
            <h3 class="text-md mb-2 ml-8 font-bold">{{ Auth::user()->name }}&nbsp;<span class="text-sm font-normal">さん</span></h3>

            {{-- edit --}}
            <a class="px-8 py-2 text-sm text-neutral-500 transition-all hover:bg-neutral-100" href="{{ route('profile.edit') }}">アカウント</a>

            {{-- logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full px-8 py-2 text-left text-sm text-red-500 transition-all hover:bg-red-100" type="submit">ログアウト</button>
            </form>
        </div>
    </nav>

</aside>
