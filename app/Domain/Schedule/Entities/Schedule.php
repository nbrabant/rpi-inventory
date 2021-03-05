<?php

namespace App\Domain\Schedule\Entities;

use App\Domain\Recipe\Entities\Recipe;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
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

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function getColorAttribute()
    {
        if ($this->type_schedule == 'recette') {
            return '#330000';
        } elseif ($this->type_schedule == 'rendezvous') {
            return '#003300';
        } elseif ($this->type_schedule == 'planning') {
            return '#000033';
        }
    }

    // @TODO : refactor this...
    public function scopeByDateInterval($query, $dates = '')
    {
        if (!isset($dates->startAt)) {
            $startDate = Carbon::now()->startOfWeek();
        } elseif ($dates->startAt instanceof Carbon) {
            $startDate = $dates->startAt;
        } elseif (is_string($dates->startAt)) {
            $startDate = new Carbon($dates->startAt);
        }

        if (!isset($startDate)) {
            $startDate = Carbon::now()->startOfWeek();
        }

        if (!isset($dates->endAt)) {
            $endDate = Carbon::now()->endOfWeek();
        } elseif ($dates->endAt instanceof Carbon) {
            $endDate = $dates->endAt;
        } elseif (is_string($dates->endAt)) {
            $endDate = new Carbon($dates->endAt);
        }

        if (!isset($endDate)) {
            $endDate = Carbon::now()->endOfWeek();
        }

        $query->whereBetween('start_at', [$startDate, $endDate]);
        $query->whereBetween('end_at', [$startDate, $endDate]);

        return $query;
    }

    public function toArray()
    {
        $array = parent::toArray();

        $array['start'] = $this->start_at->format('Y-m-d\TH:i:s');
        $array['end']   = $this->end_at->format('Y-m-d\TH:i:s');
        $array['color'] = $this->color;

        return $array;
    }
}
