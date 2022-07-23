<?php

namespace gazmendsahiti\CcPointe\Interfaces;

use gazmendsahiti\CcPointe\CardPointe;

interface CardConnectInterface
{

    public function inquireMerchant(): CardPointe;

    public function authorization(array $parameters): CardPointe;

    public function capture(array $parameters): CardPointe;

    public function void(array $parameters): CardPointe;

    public function refund(array $parameters): CardPointe;

    public function inquire(string|int $retRef): CardPointe;

    public function inquireByOrderId(string|int $orderID): CardPointe;

    public function voidByOrderId(array $parameters): CardPointe;

    public function settlementStatus(string $date = '', string|int $batchId = ''): CardPointe;

    public function funding(string $date): CardPointe;

    public function getProfile(array $parameters): CardPointe;

    public function createProfile(array $parameters): CardPointe;

    public function updateProfile(array $parameters): CardPointe;

    public function deleteProfile(array $parameters): CardPointe;

    public function signatureCapture(array $parameters): CardPointe;

    public function bin(string $date): CardPointe;

}