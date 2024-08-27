{{-- top --}}
<div class="flex flex-row flex-nowrap bg-neutral-600 text-white">

    <!-- Logo -->
    <div class="flex w-60 shrink-0 shrink-0 items-center justify-center border-r border-neutral-500 px-8 text-xl font-extrabold">
        <a href="{{ route('dashboard') }}" class="block w-full">
            <p class="block w-auto fill-current">Proofsheet</p>
        </a>
    </div>

    {{-- info --}}
    <div class="flex h-14 w-full items-center gap-4 px-6">
        <h4 class="text-md shrink-0 font-bold text-white">@yield('title')</h4>
    </div>
</div>
