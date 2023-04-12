<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllContractsCollection;
use App\Http\Resources\UserCollection;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {

        try {
            $contracts = Contract::where('user_id', $id)->orderBy('created_at', 'desc')->get();
            $user = User::where('id', $id)->get();
            return response()->json([
                'contracts' => new AllContractsCollection($contracts),
                'user' => new UserCollection($user)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
