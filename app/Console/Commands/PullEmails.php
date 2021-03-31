<?php

namespace App\Console\Commands;

use App\Models\Release;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class PullEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $messages = DB::connection('cargospot')
            ->table('awb_msg')
            ->where('header', 'like', '%no-reply@ccn.com%')
            ->where('create_date', '>=', Carbon::today()->subWeek())
            ->get();
        foreach ($messages as $message) {
            $myArray = [];
            $lines = explode(PHP_EOL, strip_tags($message->text));
            array_shift($lines);
            $l = 0;
            foreach ($lines as $line) {
                $keywords = preg_split('~  +~', $line, -1,  PREG_SPLIT_NO_EMPTY);
                // dump($keywords);
                if (count($keywords) >= 8) {
                    if (array_key_exists(8, $keywords)) {
                        $x = $keywords[8];
                    } else {
                        $x = '';
                    }
                    Release::firstOrCreate(array(
                        'sad_id' => $keywords[0],
                        'customs_office_code' => $keywords[1],
                        'release_date' => Carbon::parse($keywords[2]),
                        'manifest_number' => $keywords[3],
                        'awb_number' => $keywords[4],
                        'lp_ref' => $keywords[5],
                        'qty' => $keywords[6],
                        'weight' => $keywords[7],
                        'description' => $x
                    ));
                    $this->updateCargospot($keywords[4], $keywords[2]);
                } else {
                    $this->info('Skipped' . print_r($keywords));
                }
            }
        }
    }

    public function updateCargospot($awb, $release_date)
    {
        $seq = $this->getAwbSeq($awb);
        if ($seq != 0) {
            $string = 'Release Date: ' . $release_date . ' For AWB ' . $awb;
            $messages = DB::connection('cargospot')
                ->table('awb_dlv')
                ->where('awb_seq', $seq)
                ->update(array('remarks_int' => $string));
        }
    }

    public function getAwbSeq($awb)
    {
        $awbs = explode("-", $awb);
        if (count($awbs) > 1) {
            $x =  DB::connection('cargospot')
                ->table('awb')
                ->where('serial',  $awbs[1])
                ->first();
            if ($x != null) {
                return  $x->seq;
            } else {
                return  0;
            }
        } else {
            return  0;
        }
    }
}
