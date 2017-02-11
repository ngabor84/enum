<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Enum\Enum;

class EnumTest extends TestCase
{

    /**
     * @test
     */
    public function checkInstance() {
        $this->assertInstanceOf(Enum::class, new class extends Enum{});
    }

    public function enumDataProvider() {
        return [
            [
                [
                    'ONE'   => 'one',
                    'TWO'   => 'two',
                    'THREE' => 'three'
                ],
                new class extends Enum {
                    const ONE   = 'one';
                    const TWO   = 'two';
                    const THREE = 'three';
                }
            ],
            [
                [
                    'ACTIVE' => 1,
                    'PASSIVE' => 0,
                ],
                new class extends Enum {
                    const ACTIVE  = 1;
                    const PASSIVE = 0;
                }
            ],
        ];
    }

    /**
     * @test
     * @dataProvider enumDataProvider
     */
    public function listEnumOptions($expectedOptions, $enum) {
        $this->assertEquals($expectedOptions, $enum::listOptions());
    }

    /**
     * @test
     * @dataProvider enumDataProvider
     */
    public function listEnumKeys($expectedOptions, $enum) {
        $this->assertEquals(array_keys($expectedOptions), $enum::listKeys());
    }

    /**
     * @test
     * @dataProvider enumDataProvider
     */
    public function listEnumValues($expectedOptions, $enum) {
        $this->assertEquals(array_values($expectedOptions), $enum::listValues());
    }

    /**
     * @test
     */
    public function createEnumWithValue() {
        $enum = new class('one') extends Enum {
            const ONE = 'one';
        };
        $this->assertEquals('one', $enum->getValue());
    }

}
