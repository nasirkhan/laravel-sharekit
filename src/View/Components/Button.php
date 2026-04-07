<?php

namespace Nasirkhan\LaravelSharekit\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Nasirkhan\LaravelSharekit\Support\ThemeManager;

class Button extends Component
{
    public array $classes;

    public function __construct(
        public string $network,
        public ?string $label = null,
        public ?string $theme = null,
        public ?string $href = '#',
        public bool $showLabel = true,
        public ?string $buttonClass = null,
        public ?string $iconClass = null,
        public ?string $labelClass = null,
        public ?string $size = 'md',
        public bool $popup = true,
    ) {
        $this->network = Str::lower(trim($this->network));
        $this->label = $this->label ?: (string) config("sharekit.labels.{$this->network}", Str::headline($this->network));
        $this->theme = $this->theme ?: config('sharekit.theme', 'default');
        $this->classes = ThemeManager::classes($this->theme);
    }

    public function render(): View
    {
        return view('sharekit::components.button');
    }
}
