<?php

namespace Nasirkhan\LaravelSharekit\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MetadataResolver
{
    public function resolve(array $overrides = [], ?Request $request = null): array
    {
        $request ??= request();

        $fallback = [
            'url'         => $request?->fullUrl() ?: url()->current(),
            'title'       => Arr::get($overrides, 'title') ?: config('app.name'),
            'text'        => Arr::get($overrides, 'text') ?: Arr::get($overrides, 'title') ?: config('app.name'),
            'description' => Arr::get($overrides, 'description'),
            'image'       => Arr::get($overrides, 'image'),
            'via'         => Arr::get($overrides, 'via'),
            'hashtags'    => Arr::get($overrides, 'hashtags'),
        ];

        return array_merge($fallback, array_filter($overrides, static fn ($value) => $value !== null && $value !== ''));
    }
}
