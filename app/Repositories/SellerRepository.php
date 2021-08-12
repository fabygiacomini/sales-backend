<?php


namespace App\Repositories;


use App\Models\Seller;

class SellerRepository
{
    private $seller;

    public function __construct(Seller $seller)
    {
        $this->seller = $seller;
    }

    public function getSellers()
    {
        return $this->seller->all();
    }

    public function deleteSeller(int $id)
    {
        return $this->seller->where('id', $id)->delete();
    }

    public function editCreateSeller($id, $name, $email, $commissionFee)
    {
        $this->seller->updateOrCreate(
            ['id' => $id],
            ['name' => $name, 'email' => $email, 'commission_fee' => $commissionFee]
        );
    }
}
