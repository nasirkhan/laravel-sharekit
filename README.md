# Laravel Sharekit

<p align="center"><img src="https://res.cloudinary.com/dslg1fc8y/image/upload/v1775567546/laravel-sharekit-logo_vaqgpc.jpg" alt="Laravel Sharekit - Reusable Blade-powered social sharing buttons for Laravel applications"></p>

Laravel Sharekit provides reusable Blade-powered social sharing buttons for Laravel applications.

It is designed to work well as a standalone package or alongside packages like `nasirkhan/laravel-cube` when you want social sharing on selected frontend pages without loading sharing assets globally.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nasirkhan/laravel-sharekit.svg?style=flat-square)](https://packagist.org/packages/nasirkhan/laravel-sharekit)
[![Total Downloads](https://img.shields.io/packagist/dt/nasirkhan/laravel-sharekit.svg?style=flat-square)](https://packagist.org/packages/nasirkhan/laravel-sharekit)
[![StyleCI](https://github.styleci.io/repos/1155376409/shield?branch=main&style=flat-square)](https://github.styleci.io/repos/1155376409)

## Features

- Blade component for grouped share buttons
- Metadata auto-detection from page meta tags and document data
- Per-instance prop overrides for URL, title, description, image, hashtags, and more
- Page-scoped CSS and JS loaded only when the component is rendered
- Native Web Share API support where available
- Popup-based sharing for common social networks
- Copy-link action with feedback state
- Configurable default theme, labels, enabled networks, popup size, and stack names
- Theme-ready structure with `default` and `tailwind` presets, with room for future themes

## Requirements

- PHP ^8.3
- Laravel ^11.0 || ^12.0 || ^13.0

## Installation

Install the package via Composer:

```bash
composer require nasirkhan/laravel-sharekit
```

The package uses Laravel package discovery, so no manual provider registration is needed.

## Publish Configuration

If you want to customize defaults, publish the config file:

```bash
php artisan vendor:publish --tag=sharekit-config
```

If you want to override the package Blade views:

```bash
php artisan vendor:publish --tag=sharekit-views
```

## Layout Requirements

Sharekit pushes page-scoped CSS and JS into Blade stacks.

Your layout should include:

```blade
@stack('after-styles')
```

inside the `<head>` section, and:

```blade
@stack('after-scripts')
```

before the closing `</body>` tag or in your layout footer.

These stack names are configurable in `config/sharekit.php`.

## Basic Usage

Render the buttons with page metadata auto-detection:

```blade
<x-sharekit::buttons />
```

This is useful when your page already includes tags like:

- `og:url`
- `og:title`
- `og:description`
- `og:image`
- `twitter:title`
- `twitter:description`
- `twitter:image`
- `link[rel="canonical"]`

## Usage With Overrides

```blade
<x-sharekit::buttons
    :url="route('posts.show', $post)"
    :title="$post->name"
    :description="$post->intro"
    :image="$post->featured_image_url"
    :hashtags="['laravel', 'sharing']"
    :networks="['x', 'facebook', 'linkedin', 'copy', 'native']"
/>
```

## Tailwind Example

```blade
<x-sharekit::buttons
    theme="tailwind"
    :url="route('posts.show', $post)"
    :title="$post->name"
    :description="$post->intro"
    :image="$post->featured_image_url"
    :networks="['x', 'facebook', 'linkedin', 'copy', 'native']"
/>
```

## Available Props

`<x-sharekit::buttons />` supports these main props:

- `url`
- `title`
- `text`
- `description`
- `image`
- `via`
- `hashtags`
- `networks`
- `theme`
- `label`
- `show-labels`
- `show-heading`
- `size`
- `popup`
- `native`

## Supported Networks

By default the package supports:

- `x`
- `facebook`
- `linkedin`
- `whatsapp`
- `telegram`
- `reddit`
- `email`
- `copy`
- `native`

You can change the defaults in the config file or pass `:networks="[...]"` directly in the component.

## Metadata Resolution

Sharekit resolves metadata in this order:

1. Props passed directly to the component
2. Page metadata detected in the browser from Open Graph, Twitter, canonical, and standard meta tags
3. Server-side fallback values such as current URL and app name

This lets you drop the component into a page with good meta tags and get sensible share output with minimal configuration.

## Themes

The package currently includes:

- `default`
- `tailwind`

Theme mappings live in `config/sharekit.php`, so you can adjust classes or add future themes later without changing the package API.

## Configuration

The config file includes options for:

- default theme
- Blade stack names
- popup dimensions
- whether native sharing is enabled when available
- default enabled networks
- label text
- theme class maps

Example:

```php
'stack_names' => [
    'styles' => 'after-styles',
    'scripts' => 'after-scripts',
],
```

## Working With Laravel Cube

Laravel Sharekit works nicely with `nasirkhan/laravel-cube`.

A typical pattern is:

- use Cube for shared UI, layout, forms, navigation, and base frontend components
- use Sharekit only on content-detail pages such as posts, news items, events, or products

Example:

```blade
<x-cube::header-block :title="$post->name" />

<x-sharekit::buttons
    theme="tailwind"
    :url="route('posts.show', $post)"
    :title="$post->name"
    :description="$post->intro"
    :image="$post->featured_image_url"
/>
```

## Testing

```bash
vendor/bin/phpunit
```

## Suggested GitHub Topics

You can use these as GitHub repository topics/tags:

- laravel
- php
- blade-components
- social-share
- share-buttons
- sharing
- laravel-package
- reusable-components
- frontend
- web-share-api
- tailwindcss
- bootstrap

## Composer Keywords Suggestion

Suggested package keywords:

- laravel
- sharing
- social-share
- social-sharing
- blade-components
- share-buttons
- share-links
- sharekit
- web-share-api
- frontend

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions, feedback, and suggestions are welcome.

## Security

If you discover any security related issues, please email `nasir8891@gmail.com` instead of using the issue tracker.

## Credits

- [Nasir Khan](https://github.com/nasirkhan)

## License

The GNU General Public License v3.0 or later. Please see [LICENSE](LICENSE) for more information.

