<?php

use App\Models\User;

    function authResponse(User $user, $token)
    {
        return [
            'success'=> true,
            'user' => $user,
            'token'=> $token
        ];
    }


    function success($data, $status = 200)
    {
        return response($data, $status);
    }

     function error($data, $status = 401)
    {
        return response($data, $status);
    }
