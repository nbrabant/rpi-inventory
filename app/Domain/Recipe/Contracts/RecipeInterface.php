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
}