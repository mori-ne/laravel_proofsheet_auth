@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
    $alignmentClasses = match ($align) {
        'left' => 'ltr:origin-bottom-left rtl:origin-bottom-right start-0',
        'bottom' => 'origin-bottom',
        default => 'ltr:origin-bottom-right rtl:origin-bottom-left end-0',
    };

    $width = match ($width) {
        '48' => 'w-48',
        default => $width,
    };
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" class="{{ $width }} {{ $alignmentClasses }} absolute z-50 mb-8 rounded-sm shadow-md" style="display: none;" @click="open = false">
        <div class="{{ $contentClasses }} rounded-sm ring-1 ring-black ring-opacity-5">
            {{ $content }}
        </div>
    </div>

    <div @click="open = ! open">
        {{ $trigger }}
    </div>


</div>
