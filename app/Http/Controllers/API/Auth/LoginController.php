<?php

namespace App\Http\Controllers\API\Auth;

use App\Exceptions\API\Auth\AuthenticationFailureException;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Responses\API\Auth\TokenResponse;
use App\Services\IdentityService;
use Symfony\Component\HttpFoundation\Response;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $identityService
    ) {
    }

    public function __invoke(LoginRequest $request)
    {
        if (! $this->identityService->login($request->payload())) {
            throw new AuthenticationFailureException(
                message: 'Invalid Credentials',
                code: Response::HTTP_BAD_REQUEST,
            );
        }

        $token = $this->identityService->createToken('CARDBOARD_TOKEN');

        return new TokenResponse($token);
    }
}
