<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Order\Order;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Log;

class Hitung implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request = null;
    private $orderid = '';
    private $ordernum = '';



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        // var_dump($request);
        $this->orderid = $request['orderid'];
        $this->ordernum = $request['ordernum'];

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
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln('attempt');

        $exception = DB::transaction(function() {
            Order::
            where('ordhdr_id', $this->orderid)
            ->update([
                'ordhdr_pay_status' => 'W',
                ]);

                
            $user_id = Auth::user()->user_id;
            $allUsersCount=DB::select(" select * from kka_dab.order_calc($this->orderid, '$this->ordernum', $user_id)");
            
            
            Order::
            where('ordhdr_id', $this->orderid)
            ->update(['ordhdr_pay_status' => 'C',]);
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln('finish');
        });

        

        // return true;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });

        Queue::after(function (JobProcessed $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()

            Order::
            where('ordhdr_id', $this->orderid)
            ->update(['ordhdr_pay_status' => 'C',]);
        });
    }
}
