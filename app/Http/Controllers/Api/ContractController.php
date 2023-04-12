<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContractRequest;
use App\Http\Resources\AllContractsCollection;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $contracts =  Contract::when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        })->orderBy('id', 'desc')->get();

        return ContractResource::collection($contracts);
    }

    public function show($id)
    {
        try {
            $contract = Contract::where('id', $id)->get();
            $contracts = Contract::where('user_id', $contract[0]->user_id)->get();

            $ids = $contracts->map(function ($contract) {
                return $contract->id;
            });

            return response()->json([
                'contract' => new AllContractsCollection($contract),
                'ids' => $ids
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function store(StoreContractRequest $request)
    {
        $contract = $request->validated();
        try {
            $contract['user_id'] = auth()->user()->id;
            Contract::create($contract);
            return response()->json(['sucess' => 'OK'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
