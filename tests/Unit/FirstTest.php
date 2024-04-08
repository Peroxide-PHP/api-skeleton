<?php

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(stdClass::class)]
final class FirstTest extends PHPUnit\Framework\TestCase
{
    public function testOneTestToCheckPhpUnit()
    {
        $this->assertEquals(1, 1);
    }
}