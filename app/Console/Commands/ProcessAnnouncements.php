<?php

namespace App\Console\Commands;

use App\Models\Announcement;
use Illuminate\Console\Command;

class ProcessAnnouncements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:announcements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tagged announcement as active or inactive depending on start and end date.';

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
     * @return int
     */
    public function handle()
    {
        $announcements = Announcement::where("status","=",true)->whereDate("enddate","<", today())->update([
            "status" => false,
        ]);
        $announcements = Announcement::where("status","=",false)->whereDate("startdate",">=", today())->update([
            "status" => true,
        ]);
    }
}
