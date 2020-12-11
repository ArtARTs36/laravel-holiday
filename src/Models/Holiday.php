<?php

namespace ArtARTs36\LaravelHoliday\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property int $name_id
 * @property int $work_type_id
 * @property WorkType $workType
 * @property Country $country
 * @property int $country_id
 */
class Holiday extends Model
{
    public const FIELD_DATE = 'date';
    public const FIELD_WORK_TYPE_ID = 'work_type_id';
    public const FIELD_TITLE = 'title';
    public const FIELD_COUNTRY_ID = 'country_id';

    public const RELATION_WORK_TYPE = 'workType';
    public const RELATION_COUNTRY = 'country';

    protected $table = 'holiday_holidays';

    protected $fillable = [
        self::FIELD_DATE,
        self::FIELD_WORK_TYPE_ID,
        self::FIELD_TITLE,
        self::FIELD_COUNTRY_ID,
    ];

    /**
     * @codeCoverageIgnore
     */
    public function workType(): BelongsTo
    {
        return $this->belongsTo(WorkType::class);
    }

    /**
     * @codeCoverageIgnore
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
