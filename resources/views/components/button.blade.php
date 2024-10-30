<!-- Link to the button styles -->
<link rel="stylesheet" href="{{ asset('assets/css/button.css') }}">

<!-- resources/views/components/button.blade.php -->
@props(['text', 'url', 'type', 'variant', 'onclick'])

<!-- Check the type of button to render accordingly -->
@if ($type === 'submit')
    <button 
        type="submit" 
        class="btn btn-{{ $variant }}" 
        @if($onclick) onclick="{{ $onclick }}" @endif
    >
        {{ $text }}
    </button>
@elseif ($type === 'button')
    <button 
        type="button" 
        class="btn btn-{{ $variant }}" 
        onclick="window.location.href='{{ $url }}'; {{ $onclick }}"
    >
        {{ $text }}
    </button>
@else
    <a 
        href="{{ $url }}" 
        class="btn btn-{{ $variant }}" 
        @if($onclick) onclick="{{ $onclick }}" @endif
    >
        {{ $text }}
    </a>
@endif
