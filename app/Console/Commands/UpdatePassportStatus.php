<?php

namespace App\Console\Commands;

use App\Models\Passport;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdatePassportStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-passport-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly update passport expirty status';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */

    public function handle()
    {
        $now = Carbon::now();
        $sixMonthsPeriod = $now->copy()->addMonths(6);

        $passports = Passport::where('expiry_date', '<=', $sixMonthsPeriod)->get();
        foreach ($passports as $passport) {
            $exipryDate = Carbon::parse($passport->expiry_date);
            if ($exipryDate->eq($sixMonthsPeriod)) {
                $passport->status = 'expired';
            } else if ($exipryDate->lte($sixMonthsPeriod)) {
                $passport->status = 'warning';
            } else {
                continue;
            }
            $passport->save();
        }
        $this->info('Passport status updated successfully!');
    }
}
