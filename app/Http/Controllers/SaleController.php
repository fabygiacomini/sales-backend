<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $repository;

    public function __construct(SaleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getSales(Request $request, string $sellerName = null)
    {
        return response()->json($this->repository->getSale($sellerName));
    }

    public function insertSale(SaleRequest $request)
    {
        try {
            $sellerId = $request->input('seller_id');
            $saleValue = $request->input('sale_value');

            $this->repository->insertSale($sellerId, $saleValue);

            return response()->json(['message' => 'Venda inserida com sucesso!']);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Ocorreu um erro ao inserir a venda. ', 'exception' => $ex->getMessage()]);
        }
    }
}
