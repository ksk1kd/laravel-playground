<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class BatchTestJob implements ShouldQueue
{
    use Batchable, Queueable;

    public function __construct()
    {
    }

    public function handle(): void
    {
        sleep(5);
    }
}