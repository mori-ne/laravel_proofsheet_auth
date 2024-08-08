@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded ']) !!}>
