<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Geeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geeting {name} {--exclamation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Say hello to you';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $tail = $this->option('exclamation') ? '!' : '.';

        $time = $this->choice('What time is it now?', ['Morning', 'Afternoon', 'Evening'], $allowMultipleSelections = false);
        switch ($time) {
            case 'Morning':
                $head = 'Good morning';
                break;
            case 'Evening':
                $head = 'Good evening';
                break;
            default:
                $head = 'Hello';
        }

        $this->info($head . ', ' . $name . $tail);
    }
}
