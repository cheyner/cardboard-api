<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Responses\API\Auth\TokenResponse;
use App\Services\IdentityService;
use Symfony\Component\HttpFoundation\Response;

final readonly class RegisterController
{
    public function __construct(
        private IdentityService $identityService
    ) {
    }

    public function __invoke(RegisterRequest $request)
    {
        if (! $this->identityService->register($request->payload())) {
            throw new \Exception(
                message: 'Unable to create account',
                code: Response::HTTP_BAD_REQUEST
            );
        }

        $token = $this->identityService->createToken('CARDBOARD_TOKEN');

        return new TokenResponse($token);
    }
}
