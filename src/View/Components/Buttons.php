<?php

namespace Nasirkhan\LaravelSharekit\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Nasirkhan\LaravelSharekit\Support\MetadataResolver;
use Nasirkhan\LaravelSharekit\Support\ThemeManager;

class Buttons extends Component
{
    public array $resolvedMetadata;

    public array $resolvedNetworks;

    public array $classes;

    public function __construct(
        public ?string $url = null,
        public ?string $title = null,
        public ?string $text = null,
        public ?string $description = null,
        public ?string $image = null,
        public ?string $via = null,
        public string|array|null $hashtags = null,
        public string|array|null $networks = null,
        public ?string $theme = null,
        public ?string $label = null,
        public bool $showLabels = true,
        public bool $showHeading = false,
        public ?string $id = null,
        public ?string $class = null,
        public ?string $buttonClass = null,
        public ?string $iconClass = null,
        public ?string $labelClass = null,
        public ?string $headingClass = null,
        public ?string $size = 'md',
        public bool $popup = true,
        public bool $native = true,
    ) {
        $metadataResolver = new MetadataResolver;

        $this->resolvedMetadata = $metadataResolver->resolve([
            'url' => $this->url,
            'title' => $this->title,
            'text' => $this->text,
            'description' => $this->description,
            'image' => $this->image,
            'via' => $this->via,
            'hashtags' => $this->normalizeHashtags($this->hashtags),
        ]);

        $configuredNetworks = config('sharekit.networks', []);
        $this->resolvedNetworks = collect($this->normalizeArray($this->networks ?: $configuredNetworks))
            ->map(fn (string $network) => Str::of($network)->lower()->trim()->value())
            ->filter()
            ->unique()
            ->when(! $this->native, fn ($collection) => $collection->reject('native'))
            ->values()
            ->all();

        $this->theme = $this->theme ?: config('sharekit.theme', 'default');
        $this->label = $this->label ?: config('sharekit.labels.share', 'Share');
        $this->id = $this->id ?: 'sharekit-'.Str::lower(Str::random(8));
        $this->classes = ThemeManager::classes($this->theme);
    }

    public function render(): View
    {
        return view('sharekit::components.buttons');
    }

    public function networkLabel(string $network): string
    {
        return (string) config("sharekit.labels.{$network}", Str::headline($network));
    }

    public function popupWidth(): int
    {
        return (int) config('sharekit.popup.width', 620);
    }

    public function popupHeight(): int
    {
        return (int) config('sharekit.popup.height', 700);
    }

    protected function normalizeArray(string|array|null $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        return array_filter(array_map('trim', explode(',', (string) $value)));
    }

    protected function normalizeHashtags(string|array|null $hashtags): ?string
    {
        $normalized = collect($this->normalizeArray($hashtags))
            ->map(static fn (string $tag) => ltrim(trim($tag), '#'))
            ->filter()
            ->implode(',');

        return $normalized !== '' ? $normalized : null;
    }
}
