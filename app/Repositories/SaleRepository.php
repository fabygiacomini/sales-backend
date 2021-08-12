<?php


namespace App\Repositories;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;

class SaleRepository
{
    private $saleModel;
    private $sellerModel;

    private $salesForMail;

    public function __construct(Sale $sale, Seller $seller)
    {
        $this->saleModel = $sale;
        $this->sellerModel = $seller;
    }

    public function getSale($sellerName)
    {

        if (isset($sellerName) && $sellerName !== null) {
            return DB::table('sale')
                ->join('seller', 'sale.seller_id', '=', 'seller.id')
                ->select('sale.*', 'seller.name', 'seller.email')
                ->where('seller.name', 'like', '%'. $sellerName . '%')
                ->orderBy('sale.sale_time', 'desc')
                ->get();
        }

        return DB::table('sale')
            ->join('seller', 'sale.seller_id', '=', 'seller.id')
            ->select('sale.*', 'seller.name', 'seller.email')
            ->orderBy('sale.sale_time', 'desc')
            ->get();
    }

    public function insertSale($sellerId, $saleValue)
    {
        $seller = $this->sellerModel->findOrFail($sellerId);

        $commissionFee = $seller->commission_fee ?? 8.5;

        $this->saleModel->seller_id = $sellerId;
        $this->saleModel->sale_value = $saleValue;
        $this->saleModel->sale_commission = $this->calculateCommission($commissionFee, $saleValue);
        $this->saleModel->sale_time = date("Y-m-d H:i:s");

        return $this->saleModel->save();
    }

    private function calculateCommission($commissionFee, $saleValue)
    {
        if ($commissionFee == null) {
            return 0;
        }
        return ($saleValue * $commissionFee) / 100;
    }

    public function getSalesForMail()
    {
        $currentDate = date('Y-m-d', time());

        $sales = DB::table('sale')
            ->join('seller', 'sale.seller_id', '=', 'seller.id')
            ->select('sale.*', 'seller.name', 'seller.email')
            ->where('sale.sale_time', 'like', $currentDate . '%')
            ->orderBy('sale.sale_time', 'desc')
            ->get();

        $this->salesForMail = $sales;

        return $sales;
    }

    public function calcTotalSales()
    {
        $total = 0;
        if (count($this->salesForMail) <= 0) {
            return $total;
        }

        foreach ($this->salesForMail as $sale) {
            $total += $sale->sale_value;
        }
        return $total;
    }
}
