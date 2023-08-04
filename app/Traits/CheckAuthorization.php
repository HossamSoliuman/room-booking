<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait CheckAuthorization
{
    public function isOwner($userId){
        return auth()->id() == $userId;
    }
}