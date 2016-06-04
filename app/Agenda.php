<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
	//columns
    protected $fillable = [
		'recette_id',
		'date_recette',
		'moment',
		'realise'
	];

	protected $dates = ['date_recette'];

	//hierarchical
	public function recette() {
		return $this->belongsTo('App\Recette');
	}

	//scope functions
	public function scopeByDateInterval($query, $date = '') {
		$startDate 	= isset($dates['startAt']) ? $dates['startAt'] : Carbon::now()->startOfWeek();
		$endDate 	= isset($dates['endAt']) ? $dates['endAt'] : Carbon::now()->endOfWeek();

		$query->whereBetween('date_recette', [$startDate, $endDate]);
		return $query;
	}
}
