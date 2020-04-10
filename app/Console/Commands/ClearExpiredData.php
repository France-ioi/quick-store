<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DataRecord;
use App\User;
use DateTime;
use DateInterval;

class ClearExpiredData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear expired data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // clear expired prefixes
        $time = $this->getExpiration(config('data_record.prefix_expiration_interval'));
        User::where('last_access', '<=', $time)->delete();

        // clear expired data records only
        $time = $this->getExpiration(config('data_record.key_expiration_interval'));
        DataRecord::where('last_access', '<=', $time)->delete();
    }


    private function getExpiration($interval) {
        $time = new DateTime();
        $period = new DateInterval($interval);
        $time->sub($period);
        return $time;
    }
}
