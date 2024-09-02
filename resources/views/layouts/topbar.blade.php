{{-- top --}}
<div class="flex flex-row flex-nowrap bg-neutral-600 text-white">

    <!-- Logo -->
    <div class="flex w-44 shrink-0 items-center border-r border-neutral-500 pl-4 text-lg font-extrabold">
        <a href="{{ route('dashboard') }}" class="block w-full">
            <p class="block w-auto fill-current">Proofsheet</p>
        </a>
    </div>

    {{-- info --}}
    <div class="flex h-14 w-full items-center gap-4 px-6">
        <h4 class="text-md shrink-0 font-bold text-white">@yield('title')</h4>
    </div>
</div>
