<aside class="flex-none bg-white p-6 w-60 border-neutral-300 border-r">
    {{-- メインメニュー --}}
    <div class="mb-8">
        <h3 class="font-bold text-lg mb-3">メインメニュー</h3>
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
        <h3 class="font-bold text-lg mb-3">管理項目</h3>
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
                    <i class="at-write-book-bold"></i>
                    <a class="block text-gray-300" href="#">入力項目管理</a>
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
        <h3 class="font-bold text-lg mb-3">作成項目</h3>
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
        <h3 class="font-bold text-lg mb-3">投稿者項目</h3>
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
</aside>
