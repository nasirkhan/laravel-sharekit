<?php

namespace Nasirkhan\LaravelSharekit\Support;

class ThemeManager
{
    public static function classes(?string $theme = null): array
    {
        $theme = $theme ?: config('sharekit.theme', 'default');
        $themes = config('sharekit.themes', []);

        return $themes[$theme] ?? $themes['default'] ?? [];
    }
}
