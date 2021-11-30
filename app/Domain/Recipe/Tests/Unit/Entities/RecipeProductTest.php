<?php

namespace App\Domain\Recipe\Tests\Unit\Entities;

use App\Domain\Recipe\Entities\RecipeProduct;
use PHPUnit\Framework\TestCase;

class RecipeProductTest extends TestCase
{
    /**
     * Test correct quantity ratio conversion
     *
     * @dataProvider ratioProvider
     *
     * @param string $unite
     * @param int $quantity
     * @param float $expected
     */
    public function testGetQuantityShouldReturnQuantityRatio(string $unite, int $quantity, float $expected): void
    {
        $recipeProduct = new RecipeProduct([
            'unit' => $unite,
            'quantity' => $quantity
        ]);

        self::assertEquals($expected, $recipeProduct->getQuantity());
    }

    /**
     * Provide recipe product informations for test
     *
     * @return mixed[]
     */
    public static function ratioProvider(): array
    {
        return [
            ['centilitre', 2, 0.2],
            ['cuilliere_cafe', 2, 8.0],
            ['cuilliere_dessert', 2, 16.0],
            ['cuilliere_soupe', 2, 24.0],
            ['verre_liqueur', 2, 0.06],
            ['tasse_cafe', 2, 0.2],
            ['verre_moutarde', 2, 0.3],
            ['grand_verre', 2, 0.5],
            ['bol', 2, 0.7],
            ['louche', 2, 2],
        ];
    }
}