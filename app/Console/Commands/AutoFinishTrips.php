<?php

namespace App\Console\Commands;

use App\Models\Trip;
use Illuminate\Console\Command;

class AutoFinishTrips extends Command
{
    protected $signature = 'trips:auto-finish';
    protected $description = 'Set open/closed trips past departure_time to finished';

    public function handle()
    {
        $count = Trip::whereIn('status', ['open', 'closed'])
            ->where('departure_time', '<=', now())
            ->update(['status' => 'finished']);

        $this->info("Auto-finished {$count} trip(s).");
    }
}
