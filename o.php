<?php

class Payment
{
    public function makePayment(string $paySystem)
    {
        if ($paySystem === 'Stripe') {
            // may pay with Stripe;
        } elseif ($paySystem === 'PayPal') {
            // may pay with PayPal;
        } else {
            // may pay with privat;
        }
    }
}

interface PaySystems
{
    public function makePay(float $sum): bool;
}

abstract class PaySystems2 implements PaySystems
{

    public int $sum = 10;

    /**
     * @param int $sum
     */
    public function __construct
    (
        int $sum
    ) {
        $this->sum = $sum;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    abstract public function makePay(float $sum): bool;
}

class Stripe implements PaySystems
{

    public function makePay(float $sum): bool
    {
        if ($sum > 0) {
            return true;
        }

        return false;
    }
}

class PayPal implements PaySystems
{
    public function getSum(): int
    {
        return 10;
    }

    public function makePay(float $sum): bool
    {
        if ($sum >= 0) {
            return true;
        }

        return false;
    }
}

class Privat implements PaySystems
{

    public function makePay(
        float $sum
    ):
    bool {
        if ($sum > 0) {
            return true;
        }

        return false;
    }
}

class PaymentNew
{
    public function makePayment(PaySystems $paySystem)
    {
        $paySystem->makePay(10);
    }
}

$payment = new Payment();
$payment->makePayment('Stripe');

$paymentNew = new PaymentNew();
$paymentNew->makePayment(new Stripe());

class NewPaymentSystem implements PaySystems
{
    public function makePay(float $sum): bool
    {
        return true;
    }
}

$paymentNew->makePayment(new NewPaymentSystem());

interface DB
{
    public function insert(array $data, string $table): void;

    public function insertGetId(array $data, string $table): int;
}

