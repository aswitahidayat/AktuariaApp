<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Order\Order;

use DB;

class Hitung implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request = null;
    private $orderid = '';
    private $ordernum = '';
    private $user_id = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $user_id)
    {
        // var_dump($request);
        $this->orderid = $request['orderid'];
        $this->ordernum = $request['ordernum'];
        $this->user_id = $user_id;

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln('construct');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $exception = DB::transaction(function() {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln('attempt');
            Order::
            where('ordhdr_id', $this->orderid)
            ->update([
                'ordhdr_pay_status' => 'W',
                ]);

            $allUsersCount=DB::select(" select * from kka_dab.order_calc($this->orderid, '$this->ordernum', $this->user_id)");            
            
            Order::
            where('ordhdr_id', $this->orderid)
            ->update(['ordhdr_pay_status' => 'C',]);
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln('finish');
        });
    }
}
