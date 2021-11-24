<?php

namespace App\Domain\Recipe\Contracts;

interface RecipeInterface
{
    /**
     * @var string[] UNITS_LIST
     */
    public const UNITS_LIST = [
        '' 					=> '---',
        'grammes' 			=> 'Grammes',
        'litre' 			=> 'Litre',
        'centilitre' 		=> 'Centilitre',
        'cuilliere_cafe' 	=> 'Cuillere à Cafe',
        'cuilliere_dessert' => 'Cuillere à Dessert',
        'cuilliere_soupe' 	=> 'Cuillere à Soupe',
        'verre_liqueur' 	=> 'Verre à liqueur',
        'verre_moutarde' 	=> 'Verre à moutarde',
        'grand_verre' 		=> 'Grand verre',
        'tasse_cafe' 		=> 'Tasse à café',
        'bol' 				=> 'Bol',
        'sachet' 			=> 'Sachet',
        'gousse' 			=> 'Gousse',
    ];

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
}