<?php

namespace App\Domain\Schedule\Entities;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\Recipe;
use App\Domain\Schedule\Contracts\ScheduleInterface;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $type_schedule
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property string $color
 */
class Schedule extends Model implements ScheduleInterface
{
    /**
     * @var string[] $fillable
     */
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

    /**
     * @var string[] $dates
     */
    protected $dates = ['start_at', 'end_at'];

    /**
     * @TODO : Recipe domain responsability
     *
     * @return BelongsTo
     */
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * @return string
     */
    public function getColorAttribute(): string
    {
        return self::SCHEDULE_COLORS[$this->type_schedule] ?? '#000000';
    }

    /**
     * @TODO : refactor this...
     *
     * @param Builder $query
     * @param string $dates
     * @return Builder
     */
    public function scopeByDateInterval(Builder $query, $dates = ''): Builder
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

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        $array = parent::toArray();

        $array['start'] = $this->start_at->format('Y-m-d\TH:i:s');
        $array['end']   = $this->end_at->format('Y-m-d\TH:i:s');
        $array['color'] = $this->color;

        return $array;
    }
}
