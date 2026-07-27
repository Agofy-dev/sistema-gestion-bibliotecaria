@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-[#fcfbfa] border-[#d1c9b8] text-[#373222] focus:border-[#5c3e21] focus:ring-[#5c3e21] rounded-md shadow-sm']) !!}>