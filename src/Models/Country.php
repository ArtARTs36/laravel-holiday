<?php

namespace ArtARTs36\LaravelHoliday\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $title
 */
class Country extends Model
{
    public const FIELD_CODE = 'code';
    public const FIELD_TITLE = 'title';

    protected $table = 'holiday_countries';

    protected $fillable = [
        self::FIELD_CODE,
        self::FIELD_TITLE,
    ];
}
