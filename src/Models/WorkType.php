<?php

namespace ArtARTs36\LaravelHoliday\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 * @property string $title
 */
class WorkType extends Model
{
    public const SLUG_FULL_TIME = 'full_time';
    public const SLUG_WEEKEND = 'weekend';
    public const SLUG_SHORT_DAY = 'short_day';

    public const HOLIDAY_SLUGS = [
        self::SLUG_WEEKEND,
        self::SLUG_SHORT_DAY,
    ];

    public const FIELD_SLUG = 'slug';
    public const FIELD_TITLE = 'title';

    protected $table = 'holiday_work_types';

    protected $fillable = [
        self::FIELD_SLUG,
        self::FIELD_TITLE,
    ];

    public static function isHoliday(string $slug): bool
    {
        return in_array($slug, static::HOLIDAY_SLUGS);
    }
}
