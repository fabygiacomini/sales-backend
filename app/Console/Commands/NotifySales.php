<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Repositories\SaleRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NotifySales extends Command
{
    private $saleRepository;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia e-mails com relatório de vendas do dia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() : void
    {
        $now = date('Y-m-d H:i', strtotime(Carbon::now()->addHour()));
        logger($now);

        dispatch(new SendMailJob($this->saleRepository->getSalesForMail(), $this->saleRepository->calcTotalSales()));
    }
}
