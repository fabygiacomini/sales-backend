<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRequest;
use App\Repositories\SellerRepository;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\App;
use PHPUnit\Exception;

class SellerController extends Controller
{
    private $repository;

    public function __construct(SellerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getSellers(Request $request)
    {
        return response()->json($this->repository->getSellers());
    }

    public function deleteSeller(Request $request, int $id)
    {
        try {

            if (!$id) {
                throw new \Exception('Identificação de vendedor inválida!');
            }

            $this->repository->deleteSeller($id);

            return response()->json(['message' => 'Vendedor removido com sucesso!']);
        } catch (Exception $ex) {
            return response()->json(['message' => 'Ocorreu um erro ao remover o vendedor']);
        }
    }

    public function editCreateSeller(SellerRequest $request)
    {
        try{
            $id = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $commissionFee = $request->input('commission_fee');

            $this->repository->editCreateSeller($id, $name, $email, $commissionFee);

            return response()->json(['message' => 'Dados de vendedor salvos com sucesso!']);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Ocorreu algum problema em salvar os dados do vendedor!', 'exception' => $ex->getMessage()]);
        }
    }
}
