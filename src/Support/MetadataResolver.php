<?php

namespace Nasirkhan\LaravelSharekit\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MetadataResolver
{
    public function resolve(array $overrides = [], ?Request $request = null): array
    {
        $request ??= request();

        // When laravel/head is installed, use its resolved metadata as the base so
        // share buttons automatically reflect og:title, og:description, og:image, etc.
        // set by controllers or route metadata — without any DOM scraping.
        $headData = $this->resolveFromHead();

        $fallback = [
            'url'         => $request?->fullUrl() ?: url()->current(),
            'title'       => Arr::get($overrides, 'title') ?: $headData['title'] ?: config('app.name'),
            'text'        => Arr::get($overrides, 'text') ?: Arr::get($overrides, 'title') ?: $headData['title'] ?: config('app.name'),
            'description' => Arr::get($overrides, 'description') ?: $headData['description'] ?: null,
            'image'       => Arr::get($overrides, 'image') ?: $headData['image'] ?: null,
            'via'         => Arr::get($overrides, 'via'),
            'hashtags'    => Arr::get($overrides, 'hashtags'),
        ];

        return array_merge($fallback, array_filter($overrides, static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Extract title, description, and image from laravel/head when available.
     * Falls back to empty strings so callers can treat missing values uniformly.
     */
    protected function resolveFromHead(): array
    {
        $empty = ['title' => '', 'description' => '', 'image' => ''];

        if (! class_exists(\Laravel\Head\Facades\Head::class)) {
            return $empty;
        }

        try {
            $data = \Laravel\Head\Facades\Head::toArray();

            return [
                'title'       => $data['title'] ?? '',
                'description' => $data['description'] ?? '',
                'image'       => $data['ogImage'][0]['url'] ?? $data['og']['image'] ?? '',
            ];
        } catch (\Throwable) {
            return $empty;
        }
    }
}
