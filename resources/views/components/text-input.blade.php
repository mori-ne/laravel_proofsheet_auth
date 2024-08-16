@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0 bg-neutral-100 shadow-sm focus:border-neutral-500 focus:ring-neutral-500 rounded ']) !!}>
