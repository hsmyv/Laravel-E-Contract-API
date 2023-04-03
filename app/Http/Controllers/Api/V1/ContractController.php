<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use App\Http\Resources\V1\ContractCollection;
use App\Http\Resources\V1\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $contracts = Contract::all();

        if ($request->search) {
            $contracts = Contract::where("name", "like", "%{$request->search}%")
                ->get();
        }

        return ContractResource::collection($contracts);
    }

    public function show(Contract $contract)
    {
        return new ContractResource($contract);
    }


    public function store(StoreContractRequest $request)
    {
        Contract::create($request->validated());
        return response()->json("Contract Created");
    }

    public function update(StoreContractRequest $request, Contract $contract)
    {
        $contract->update($request->validated());
        return response()->json("Contract Updated");
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return response()->json("Contract Deleted");
    }
}
