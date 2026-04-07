@php
    $styleStack = config('sharekit.stack_names.styles', 'after-styles');
    $scriptStack = config('sharekit.stack_names.scripts', 'after-scripts');
@endphp

@once
    @push($styleStack)
        @include('sharekit::partials.assets.styles')
    @endpush

    @push($scriptStack)
        @include('sharekit::partials.assets.scripts')
    @endpush
@endonce

<div
    {{ $attributes->merge(['class' => trim(($classes['root'] ?? '').' '.($class ?? ''))]) }}
    data-sharekit
    data-sharekit-id="{{ $id }}"
    data-sharekit-theme="{{ $theme }}"
    data-sharekit-url="{{ $resolvedMetadata['url'] ?? '' }}"
    data-sharekit-title="{{ $resolvedMetadata['title'] ?? '' }}"
    data-sharekit-text="{{ $resolvedMetadata['text'] ?? '' }}"
    data-sharekit-description="{{ $resolvedMetadata['description'] ?? '' }}"
    data-sharekit-image="{{ $resolvedMetadata['image'] ?? '' }}"
    data-sharekit-via="{{ $resolvedMetadata['via'] ?? '' }}"
    data-sharekit-hashtags="{{ $resolvedMetadata['hashtags'] ?? '' }}"
    data-sharekit-popup="{{ $popup ? 'true' : 'false' }}"
    data-sharekit-popup-width="{{ $popupWidth() }}"
    data-sharekit-popup-height="{{ $popupHeight() }}"
    data-sharekit-native="{{ config('sharekit.use_native_when_available', true) && $native ? 'true' : 'false' }}"
    data-sharekit-size="{{ $size }}"
    data-sharekit-copied-label="{{ config('sharekit.labels.copied', 'Copied') }}"
>
    @if($showHeading)
        <div class="{{ trim(($classes['heading'] ?? '').' '.($headingClass ?? '')) }}">{{ $label }}</div>
    @endif

    <div class="{{ $classes['list'] ?? '' }}" role="list" aria-label="{{ $label }}">
        @foreach($resolvedNetworks as $network)
            <div class="{{ $classes['item'] ?? '' }}" role="listitem">
                <x-sharekit::button
                    :network="$network"
                    :theme="$theme"
                    :show-label="$showLabels"
                    :button-class="$buttonClass"
                    :icon-class="$iconClass"
                    :label-class="$labelClass"
                    :size="$size"
                    :popup="$popup"
                    :label="$networkLabel($network)"
                />
            </div>
        @endforeach
    </div>
</div>
