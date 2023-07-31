<?php

namespace App\Services\Payments\DTO;

class CreateTokenDTO
{

    public function __construct(
        protected int $cardNumber,
        protected int $month,
        protected int $year,
        protected int $cvc,
    ) {
    }

    /**
     * @return int
     */
    public function getCardNumber(): int
    {
        return $this->cardNumber;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getCvc(): int
    {
        return $this->cvc;
    }

}
