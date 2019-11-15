<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Order\Order;
use App\Models\FailLog;

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

            try {
                $allUsersCount=DB::select(" select * from kka_dab.order_calc($this->orderid, '$this->ordernum', $this->user_id)");            
            } catch(Exception $e) {
                $this->writeln($e);
            }
            

            Order::
            where('ordhdr_id', $this->orderid)
            ->update(['ordhdr_pay_status' => 'C',]);
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln('finish');
        });

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($exception);
    }

    public function failed($e)
    {
        // Send user notification of failure, etc...
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln('Fail');

        $out->writeln($e);

        Order::
            where('ordhdr_id', $this->orderid)
            ->update(['ordhdr_pay_status' => 'N',]);

        $data = new FailLog();
        $data->fail_ordhdr_ordnum = $this->ordernum;
        $data->fail_date = date(now());
        $data->save();
    }
}
