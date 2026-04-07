<?php

namespace Nasirkhan\LaravelSharekit\Tests\Feature;

use Nasirkhan\LaravelSharekit\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ButtonsComponentRenderTest extends TestCase
{
    #[Test]
    public function it_renders_the_buttons_component_with_expected_attributes(): void
    {
        $view = $this->blade('<x-sharekit::buttons url="https://example.com/posts/hello" title="Hello World" :networks="[\'x\', \'copy\']" />');

        $view->assertSee('data-sharekit', false);
        $view->assertSee('data-sharekit-network="x"', false);
        $view->assertSee('data-sharekit-network="copy"', false);
        $view->assertSee('Hello World');
    }
}
