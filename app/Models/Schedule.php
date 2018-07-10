<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
	//columns
    protected $fillable = [
        'recipe_id',
        'user_id',
        'type_schedule',
        'title',
        'details',
        'start_at',
        'end_at',
        'all_day',
	];

	protected $dates = ['start_at', 'end_at'];

	//hierarchical
	public function recipe() {
		return $this->belongsTo('App\Models\Recipe');
	}

	//scope functions
	// public function scopeByDateInterval($query, $date = '') {
	// 	$startDate 	= isset($dates['startAt']) ? $dates['startAt'] : Carbon::now()->startOfWeek();
	// 	$endDate 	= isset($dates['endAt']) ? $dates['endAt'] : Carbon::now()->endOfWeek();
    //
	// 	$query->whereBetween('date_recipe', [$startDate, $endDate]);
	// 	return $query;
	// }

    public function toArray()
    {
        $array = parent::toArray();

        $array['start'] = $this->start_at->format('Y-m-d\TH:i:s');
        $array['end'] = $this->start_at->format('Y-m-d\TH:i:s');

        return $array;
    }
}
