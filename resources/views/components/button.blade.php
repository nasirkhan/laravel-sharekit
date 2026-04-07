@php
    $tag = config('sharekit.button_tag', 'button');
    $isLink = in_array($network, ['email'], true);
    $element = $isLink ? 'a' : $tag;
@endphp

<{{ $element }}
    @if($element === 'a') href="{{ $href ?: '#' }}" @endif
    @if($element !== 'a') type="button" @endif
    {{ $attributes->merge(['class' => trim(($classes['button'] ?? '').' '.($buttonClass ?? ''))]) }}
    data-sharekit-button
    data-sharekit-network="{{ $network }}"
    data-sharekit-popup="{{ $popup ? 'true' : 'false' }}"
    data-sharekit-size="{{ $size }}"
    aria-label="{{ $label }}"
>
    <span class="{{ trim(($classes['button_icon'] ?? '').' '.($iconClass ?? '')) }}" aria-hidden="true">
        <x-sharekit::icon :network="$network" />
    </span>

    @if($showLabel)
        <span class="{{ trim(($classes['button_label'] ?? '').' '.($labelClass ?? '')) }}" data-sharekit-label>{{ $label }}</span>
    @endif
</{{ $element }}>
