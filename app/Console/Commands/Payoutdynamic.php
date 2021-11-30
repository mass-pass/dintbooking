<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\{
    Settings,
    Country,
    Bookings,
    PayoutSetting,
    Withdrawal,
    Wallet,
    Payouts,
    Accounts,
    PaymentMethods,
    Currency
};
class PayoutDynamic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout:dynamic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create payout dynamically';

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
        $allActivePayouts = Bookings::where("start_date",">",date("Y-m-d"))
        ->where("bookings.status","Accepted")
        ->where("bookings.dispute_status","!=","1")
        ->join("payouts as p","p.booking_id","bookings.id")
        ->where("p.status","Future")
        ->join("payout_settings as ps","ps.user_id","p.user_id")
        ->select("ps.id as ps_id","p.id as p_id","bookings.id as booking_id","p.user_id","p.amount")
        ->get();

        foreach($allActivePayouts as $p)
        {
            $userId            = $p->user_id;
            
            $payoutSetting     = PayoutSetting::find($p->ps_id);
            $walletMoney       = Wallet::where('user_id', $userId)->first();
            $withdrawal                         = new Withdrawal;
            $withdrawal->user_id                = $userId;
            $withdrawal->currency_id            = 1;
            $withdrawal->payout_id              = $payoutSetting->id;
            $withdrawal->payment_method_id      = $payoutSetting->type;
            $withdrawal->uuid                   = uniqid();
            $withdrawal->subtotal               = $p->amount;
            $withdrawal->email                  = $payoutSetting->email;
            $withdrawal->status                 = "Pending";
            
            $withdrawal->account_number         = $payoutSetting->account_number;
            $withdrawal->bank_name              = $payoutSetting->bank_name;
            $withdrawal->swift_code             = $payoutSetting->swift_code;

            if ($walletMoney->balance >= $withdrawal->subtotal) {
                $withdrawal->save();
                
                $payout=Payouts::find($p->p_id);
                $payout->status="Completed";
                $payout->save();
                $this->info('success');
                
            } else {
                $this->info('error...');
                
            }
        }
    }
}
