<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
	//columns
    protected $fillable = [
		'recipe_id',
		'date_recipe',
		'moment',
		'finished'
	];

	protected $validators = [
		'recette_id' 	=> 'required|integer|exists:recettes,id',
		'date_recette' 	=> 'required|date_format:Y-m-d',
		'moment' 		=> 'required|in:matin,midi,soir',
	];

	protected $dates = ['date_recipe'];

	//hierarchical
	public function recipe() {
		return $this->belongsTo('App\Recipe');
	}

	//scope functions
	public function scopeByDateInterval($query, $date = '') {
		$startDate 	= isset($dates['startAt']) ? $dates['startAt'] : Carbon::now()->startOfWeek();
		$endDate 	= isset($dates['endAt']) ? $dates['endAt'] : Carbon::now()->endOfWeek();

		$query->whereBetween('date_recipe', [$startDate, $endDate]);
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

    public function toArray()
    {
        $array = parent::toArray();

        $array['start'] = Carbon::now()->addDays(2)->format('Y-m-d\TH:i:s');
        $array['end'] = Carbon::now()->addDays(2)->addHours(2)->format('Y-m-d\TH:i:s');

        return $array;
    }
}
