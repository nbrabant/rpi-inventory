<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Planning extends Model
{
	//columns
    protected $fillable = [
		'recette_id',
		'date_recette',
		'moment',
		'realise'
	];

	protected $validators = [
		'recette_id' 	=> 'required|integer|exists:recettes,id',
		'date_recette' 	=> 'required|date_format:Y-m-d',
		'moment' 		=> 'required|in:matin,midi,soir',
	];

	protected $dates = ['date_recette'];

	//hierarchical
	public function recipe() {
		return $this->belongsTo('App\Recipe');
	}

	//scope functions
	public function scopeByDateInterval($query, $date = '') {
		$startDate 	= isset($dates['startAt']) ? $dates['startAt'] : Carbon::now()->startOfWeek();
		$endDate 	= isset($dates['endAt']) ? $dates['endAt'] : Carbon::now()->endOfWeek();

		$query->whereBetween('date_recette', [$startDate, $endDate]);
		return $query;
	}

	public static function getMomentList()
	{
		return [
			'matin' => 'Matin',
			'midi' 	=> 'Midi',
			'soir' 	=> 'Soir'
		];
	}
}
