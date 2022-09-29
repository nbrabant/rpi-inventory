<?php

namespace App\Domain\Recipe\Entities\ValueObject;

class Quantity
{
    /**
     * @var string[] UNITS_LIST
     */
    public const UNIT_QUANTITY_RATIO = [
        'centilitre'        => 0.1,
        'cuilliere_cafe'    => 4,
        'cuilliere_dessert' => 8,
        'cuilliere_soupe'   => 12,
        'verre_liqueur'     => 0.03,
        'tasse_cafe'        => 0.1,
        'verre_moutarde'    => 0.15,
        'grand_verre'       => 0.25,
        'bol'               => 0.35,
    ];

    private float $quantity;
    private ?string $unit;

    /**
     * @param float $quantity
     * @param string|null $unit
     */
    public function __construct(float $quantity, ?string $unit)
    {
        $this->quantity = $quantity;
        $this->unit = $unit;
    }

    public function __toString(): string
    {
        return trans_choice('recipe.' . $this->unit, $this->getQuantity(), ['quantity' => $this->getQuantity()]);
    }

    /**
     * verbose unity
     *
     * convert quantity
     * http://tout-metz.com/recette/conversion-unite-cuisine
     * @return float
     */
    public function getQuantity(): float
    {
        if (isset(self::UNIT_QUANTITY_RATIO[$this->unit])) {
            return $this->quantity * self::UNIT_QUANTITY_RATIO[$this->unit];
        }

        return $this->quantity;
    }
}
