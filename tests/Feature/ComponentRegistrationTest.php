<?php

namespace Nasirkhan\LaravelSharekit\Tests\Feature;

use Nasirkhan\LaravelSharekit\Tests\TestCase;
use Nasirkhan\LaravelSharekit\View\Components\Button;
use Nasirkhan\LaravelSharekit\View\Components\Buttons;
use Nasirkhan\LaravelSharekit\View\Components\Icon;
use PHPUnit\Framework\Attributes\Test;

class ComponentRegistrationTest extends TestCase
{
    #[Test]
    public function it_registers_share_components(): void
    {
        $this->assertTrue(class_exists(Buttons::class));
        $this->assertTrue(class_exists(Button::class));
        $this->assertTrue(class_exists(Icon::class));
    }
}
