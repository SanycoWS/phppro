<?php

namespace App\Services\Payments\Stripe;

use App\Services\Payments\DTO\CreateTokenDTO;
use Stripe\Exception\CardException;
use Stripe\StripeClient;

class CreateTokenService
{

    public function __construct(
        protected StripeClient $stripe
    ) {
    }

    public function createToken(CreateTokenDTO $createTokenDTO)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $createTokenDTO->getCardNumber(),
                    'exp_month' => $createTokenDTO->getMonth(),
                    'exp_year' => $createTokenDTO->getYear(),
                    'cvc' => $createTokenDTO->getCvc()
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (\Exception $e) {
            $token['error'] = $e->getMessage();
        }

        return $token;
    }
}
