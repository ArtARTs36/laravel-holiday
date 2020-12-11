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
    public const CODE_RUS = 'RUS'; // Russia
    public const CODE_UKR = 'UKR'; // Ukraine
    public const CODE_KAZ = 'KAZ'; // Kazakhstan

    public const FIELD_CODE = 'code';
    public const FIELD_TITLE = 'title';

    protected $table = 'holiday_countries';

    protected $fillable = [
        self::FIELD_CODE,
        self::FIELD_TITLE,
    ];
}
