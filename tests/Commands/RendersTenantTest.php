<?php

namespace Slides\Saml2\Tests\Commands;

use PHPUnit\Framework\TestCase;
use Slides\Saml2\Commands\RendersTenants;

class RendersTenantTest extends TestCase
{
    use RendersTenants;

    public function testRenderArrayWithSimpleValues()
    {
        $array = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'admin',
        ];

        $result = $this->renderArray($array);

        $this->assertStringContainsString('name: John Doe', $result);
        $this->assertStringContainsString('email: john@example.com', $result);
        $this->assertStringContainsString('role: admin', $result);
    }

    public function testRenderArrayWithNestedArray()
    {
        $array = [
            'name' => 'Test User',
            'permissions' => ['read', 'write', 'delete'],
        ];

        $result = $this->renderArray($array);

        $this->assertStringContainsString('name: Test User', $result);
        $this->assertStringContainsString('permissions:', $result);
        $this->assertStringContainsString('read', $result);
        $this->assertStringContainsString('write', $result);
        $this->assertStringContainsString('delete', $result);
    }

    public function testRenderArrayWithNestedAssociativeArray()
    {
        $array = [
            'user' => [
                'id' => 1,
                'name' => 'Jane Doe',
            ],
        ];

        $result = $this->renderArray($array);

        $this->assertStringContainsString('user:', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('Jane Doe', $result);
    }

    public function testRenderArrayWithEmptyArray()
    {
        $array = [];

        $result = $this->renderArray($array);

        $this->assertSame('', $result);
    }

    public function testRenderArrayWithMixedTypes()
    {
        $array = [
            'string' => 'value',
            'integer' => 42,
            'boolean' => true,
            'array' => ['a' => 'b'],
        ];

        $result = $this->renderArray($array);

        $this->assertStringContainsString('string: value', $result);
        $this->assertStringContainsString('integer: 42', $result);
        $this->assertStringContainsString('boolean: 1', $result);
        $this->assertStringContainsString('array:', $result);
    }

    public function testRenderArrayReturnsFormattedOutput()
    {
        $array = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $result = $this->renderArray($array);

        $lines = explode(PHP_EOL, $result);
        $this->assertCount(2, $lines);
        $this->assertSame('key1: value1', $lines[0]);
        $this->assertSame('key2: value2', $lines[1]);
    }
}
