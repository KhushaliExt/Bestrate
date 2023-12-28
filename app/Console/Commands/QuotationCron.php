<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\sellerquery;
use Carbon\Carbon;

class QuotationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotation:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    $sellerQueries = sellerquery::where(['inquery_status' => 4])->get();

    foreach ($sellerQueries as $sellerQuery) {

        $quotationTimeEnd = Carbon::parse($sellerQuery->quotation_time_end);
        $updatedQuotationTimeEnd = $quotationTimeEnd->subMinutes(1)->format('H:i:m');
        sellerquery::where('id', $sellerQuery->id)->update(['quotation_time_end' => $updatedQuotationTimeEnd]);
    }
    }

}
