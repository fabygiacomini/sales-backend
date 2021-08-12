<?php


namespace App\Http\Controllers;


use App\Jobs\SendMailJob;
use App\Repositories\SaleRepository;

class MailController
{
    private $saleRepository;
    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }
    public function sendMail()
    {
        // chama o job de envio de emails
        dispatch(new SendMailJob($this->saleRepository->getSalesForMail(), $this->saleRepository->calcTotalSales()));
    }
}
