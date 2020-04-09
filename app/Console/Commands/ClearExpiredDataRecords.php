<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DataRecord;

class ClearExpiredDataRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear expired data records';

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
        $time = new \DateTime();
        $period = new \DateInterval(config('data_records.expiration_interval'));
        $time->sub($period);
        DataRecord::where('updated_at', '<=', $time)->delete();
    }
}
