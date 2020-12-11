<?php

namespace ArtARTs36\LaravelHoliday\Exceptions;

class SelectedCountryNotAllowed extends \LogicException
{
    protected $message = 'Selected Country not allowed!';
}
