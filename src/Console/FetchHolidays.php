<?php

namespace ArtARTs36\LaravelHoliday\Console;

use ArtARTs36\LaravelHoliday\Services\Fetch;
use Illuminate\Console\Command;

class FetchHolidays extends Command
{
    protected $signature = 'holiday:fetch {type}';

    public function handle(Fetch $fetch)
    {
        try {
            $fetch->fetch($this->argument('type'));
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
    }
}
