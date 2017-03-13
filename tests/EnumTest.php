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

    public function enumDataProvider() : array {
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
            [
                [],
                new class extends Enum { }
            ],
        ];
    }

    /**
     * @test
     * @dataProvider enumDataProvider
     */
    public function listEnumOptions(array $expectedOptions, Enum $enum) {
        $this->assertEquals($expectedOptions, $enum::listOptions());
    }

    /**
     * @test
     * @dataProvider enumDataProvider
     */
    public function listEnumKeys(array $expectedOptions, Enum $enum) {
        $this->assertEquals(array_keys($expectedOptions), $enum::listKeys());
    }

    /**
     * @test
     * @dataProvider enumDataProvider
     */
    public function listEnumValues(array $expectedOptions, Enum $enum) {
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

    /**
     * @test
     */
    public function createEnumWithInvalidValue() {
        $this->expectException('\InvalidArgumentException');

        new class('invalid value') extends Enum {
            const ONE = 'one';
        };
    }

    /**
     * @test
     * @dataProvider enumSetDataProvider
     *
     * @param $expected
     * @param $enum
     */
    public function setEnumValue($expected, $enum, $value) {
        $enum->setValue($value);
        $this->assertEquals($expected, $enum->getValue());
    }

    public function enumSetDataProvider() {
        return [
            [
                'one',
                new class extends Enum {
                    const ONE = 'one';
                    const TWO = 'two';
                },
                'one'
            ],
            [
                'active',
                new class extends Enum {
                    const ACTIVE = 'active';
                    const PASSIVE = 'passive';
                },
                'active'
            ]
        ];
    }

    /**
     * @test
     */
    public function setInvalidValue() {
        $this->expectException('\InvalidArgumentException');
        $enum = new class extends Enum {
            const ONE = 'one';
        };

        $enum->setValue('invalid value');
    }

    /**
     * @test
     */
    public function writeEnumValue() {
        $this->expectOutputString('one');

        echo new class('one') extends Enum {
            const ONE = 'one';
        };
    }

    /**
     * @test
     */
    public function checkIfKeyIsValid() {
        $enum = new class('one') extends Enum {
            const ONE = 'one';
        };

        $this->assertTrue($enum::isValidKey('ONE'));
        $this->assertFalse($enum::isValidKey('TWO'));
    }

    /**
     * @test
     */
    public function getEnumKeyByValue() {
        $enum = new class('one') extends Enum {
            const ONE = 'one';
        };

        $this->assertEquals('ONE', $enum::getKeyByValue('one'));
    }

    /**
     * @test
     */
    public function checkIfEnumsAreEqual() {
        $enumFirst = new class('one') extends Enum {
            const ONE = 'one';
            const TWO = 'two';
        };

        $enumSecond = new class('one') extends Enum {
            const ONE = 'one';
            const TWO = 'two';
        };

        $this->assertTrue($enumFirst->isEqualTo($enumSecond));
    }

    /**
     * @test
     */
    public function getEnumDefaultValue() {
        $enum = new class('one') extends Enum {
            const ONE = 'one';
        };

        $this->assertEquals('one', $enum::getDefaultValue());
    }

    /**
     * @test
     */
    public function checkEnumDefaultValue() {
        $enum = new class('one') extends Enum {
            const ONE = 'one';
            const TWO = 'two';
            const THREE = 'three';
        };

        $this->assertTrue($enum::isDefaultValue($enum::ONE));
        $this->assertFalse($enum::isDefaultValue($enum::TWO));
    }

}
