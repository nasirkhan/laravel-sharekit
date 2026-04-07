<?php

namespace Nasirkhan\LaravelSharekit\Tests\Feature;

use Nasirkhan\LaravelSharekit\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ComponentRegistrationTest extends TestCase
{
    #[Test]
    public function it_registers_share_components(): void
    {
        $this->assertTrue(class_exists(\Nasirkhan\LaravelSharekit\View\Components\Buttons::class));
        $this->assertTrue(class_exists(\Nasirkhan\LaravelSharekit\View\Components\Button::class));
        $this->assertTrue(class_exists(\Nasirkhan\LaravelSharekit\View\Components\Icon::class));
    }
}
