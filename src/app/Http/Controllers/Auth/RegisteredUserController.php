<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\CustomRegisterResponse;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    protected $creator;

    public function __construct(CreateNewUser $creator){
        $this->creator = $creator;
    }

    public function store(RegisterRequest $request):RegisterResponse{

        $user = $this->creator->create($request->validated());

        Auth::login($user);

        return new CustomRegisterResponse();
    }
}
