<?php

namespace App\Jobs;

use App\Mail\SendMailSales;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $sales;
    private $totalSales;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sales, $totalSales)
    {
        $this->sales = $sales;
        $this->totalSales = $totalSales;
    }

    /**
     * Execute the job.
     *
     * // retirado termporariamente o return para testar no postman
     */
    public function handle()
    {
        Mail::to('example@email.com')->send(new SendMailSales($this->sales, $this->totalSales));

        // Teste no Postman para evitar disparar emails, pois o MailTrap possui limitações de emails recebidos
//         echo view("email.report", [
//            'sales' => $this->sales,
//            'totalSales' => $this->totalSales
//        ]);

        // Teste inicial da cronjob para acompanhar
//        file_put_contents('testSchedule.txt', 'o job rodou às ' . date('d-m-Y H:i:s', time()) . "\n", FILE_APPEND);
    }
}
