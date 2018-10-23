<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeProduct extends Model
{
    protected $fillable = [
		'recipe_id',
		'product_id',
		'quantity',
		'unit',
	];

	public $timestamps = false;

	public function recipe()
	{
		return $this->belongsTo('App\Models\Recipe');
	}

	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}

	public static function getUniteList()
	{
		return [
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

	public function getUnite()
	{
		return self::getUniteList()[$this->unite];
	}

	// verbose unity

	// convert quantity
	// http://tout-metz.com/recette/conversion-unite-cuisine
	public function getQuantity()
	{
		if ($this->unite == 'centilitre') {
			return $this->quantite * 0.1;
		} elseif ($this->unite == 'cuilliere_cafe') {
			return $this->quantite * 4;
		} elseif ($this->unite == 'cuilliere_dessert') {
			return $this->quantite * 8;
		} elseif ($this->unite == 'cuilliere_soupe') {
			return $this->quantite * 12;
		} elseif ($this->unite == 'verre_liqueur') {
			return $this->quantite * 0.03;
		} elseif ($this->unite == 'tasse_cafe') {
			return $this->quantite * 0.1;
		} elseif ($this->unite == 'verre_moutarde') {
			return $this->quantite * 0.15;
		} elseif ($this->unite == 'grand_verre') {
			return $this->quantite * 0.25;
		} elseif ($this->unite == 'bol') {
			return $this->quantite * 0.35;
		}
		return $this->quantite;
	}

	public static function verboseUnite($unite = '')
	{
		if ($arrayName = array_key_exists(strtolower($unite), self::getUniteList())) {
			return $unite;
		}

		if ( in_array( strtolower($unite), ['g', 'grs', 'gramme']) ) {
			return 'grammes';
		} elseif ( in_array( strtolower($unite), ['l', 'litres']) ) {
			return 'litre';
		} elseif( in_array( strtolower($unite), ['cl', 'centilitres']) ) {
			return 'centilitre';
		} elseif( in_array( strtolower($unite), ['cuillère à café', 'cuillères à café', 'cuillère café', 'cuillères café']) ) {
			return 'cuilliere_cafe';
		} elseif( in_array( strtolower($unite), ['cuillère à dessert', 'cuillère à dessert', 'cuillère dessert', 'cuillère dessert']) ) {
			return 'cuilliere_dessert';
		} elseif( in_array( strtolower($unite), ['cuillère à soupe', 'cuillères à soupe', 'cuillère soupe', 'cuillères soupe']) ) {
			return 'cuilliere_soupe';
		} elseif( in_array( strtolower($unite), ['verre à liqueur', 'verres à liqueur', 'verre liqueur', 'verres liqueur']) ) {
			return 'verre_liqueur';
		} elseif( in_array( strtolower($unite), ['verre à moutarde', 'verres à moutarde', 'verre moutarde', 'verres moutarde']) ) {
			return 'verre_moutarde';
		} elseif( in_array( strtolower($unite), ['grand verre', 'grand verres']) ) {
			return 'grand_verre';
		} elseif( in_array( strtolower($unite), ['tasse à café', 'tasses à café', 'tasse café', 'tasses café']) ) {
			return 'tasse_cafe';
		} elseif( in_array( strtolower($unite), ['bols']) ) {
			return 'bol';
		} elseif( in_array( strtolower($unite), ['sachets']) ) {
			return 'sachet';
		} elseif( in_array( strtolower($unite), ['gousses']) ) {
			return 'gousse';
		}

		return $unite;
	}

    public function toArray()
    {
        $array = parent::toArray();

        $array['product_name'] = $this->product->name ?? '';
        $array['product_quantity'] = $this->quantity . ' ' . $this->getQuantity();

        return $array;
    }

}
