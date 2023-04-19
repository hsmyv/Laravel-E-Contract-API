<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;

class UserController extends Controller
{
       public function loggedInUser()
    {
         try {
            $user = User::where('id', auth()->user()->id)->get();
            return response()->json(new UserCollection($user), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function updateUserImage(Request $request)
    {
        $request->validate(['image' => 'required|mimes:png,jpg,jpeg']);
        if ($request->height === '' || $request->width === '' || $request->top === '' || $request->left === '') {
            return response()->json(['error' => 'The dimensions are incomplete'], 400);
        }

        try {
            $user = (new FileService)->updateImage(auth()->user(), $request);
            $user->save();

            return response()->json(['success' => 'OK'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateUser(Request $request)
    {
        $request->validate(['name' => 'required']);

        try {
            $user = User::findOrFail(auth()->user()->id);

            $user->name = $request->input('name');
            $user->bio  = $request->input('bio');
            $user->save();
            return response()->json(['success' => 'OK'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
