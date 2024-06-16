<?php

use App\Console\Commands\ImportScryfall;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ImportScryfall::class)
    ->purpose('Import Prices from Scryfall')
    ->daily()
    ->at('24:00')
    ->runInBackground();
