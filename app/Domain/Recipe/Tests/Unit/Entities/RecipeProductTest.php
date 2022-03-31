<?php

namespace App\Domain\Recipe\Tests\Unit\Entities;

use App\Domain\Recipe\Entities\RecipeProduct;
use Tests\TestCase;

class RecipeProductTest extends TestCase
{
    /**
     * Test correct needed quantity conversion
     *
     * @dataProvider ratioProvider
     *
     * @param string $unite
     * @param int $quantity
     * @param float $expected
     */
    public function testGetQuantityShouldReturnNeededQuantity(string $unite, int $quantity, string $expected): void
    {
        $recipeProduct = new RecipeProduct([
            'unit' => $unite,
            'quantity' => $quantity
        ]);

        self::assertEquals($expected, $recipeProduct->stock);
    }

    /**
     * Provide recipe product informations for test
     *
     * @return mixed[]
     */
    public static function ratioProvider(): array
    {
        return [
            ['centilitre', 2, '0.2 centilitre'],
            ['cuilliere_cafe', 2, '8 coffee spoons'],
            ['cuilliere_dessert', 2, '16 dessert spoons'],
            ['cuilliere_soupe', 2, '24 soup spoons'],
            ['verre_liqueur', 2, '0.06 shoot glass'],
            ['tasse_cafe', 2, '0.2 coffee cup'],
            ['verre_moutarde', 2, '0.3 mustard glass'],
            ['grand_verre', 2, '0.5 large glass'],
            ['bol', 2, '0.7 bowl'],
            ['louche', 2, '2 ladles'],
        ];
    }
}