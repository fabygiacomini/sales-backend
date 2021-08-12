<?php

namespace App\Mail;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailSales extends Mailable
{
    use Queueable, SerializesModels;

    private $sales;
    private $totalSales;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sales, $totalSales)
    {
        $this->sales = $sales;
        $this->totalSales = $totalSales;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): SendMailSales
    {
        return $this->from('homework-marketplace@email.com', 'Tray Homework')
            ->subject('Relatório de vendas do dia')
            ->view("email.report")
            ->with([
                'sales' => $this->sales,
                'totalSales' => $this->totalSales
            ]);
    }
}
