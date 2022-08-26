<?php

declare(strict_types=1);

namespace gazmendsahiti\CcPointe;

use gazmendsahiti\CcPointe\Interfaces\CardConnectInterface;
use gazmendsahiti\CcPointe\Utils\Endpoint;

class CardPointe extends RequestManager implements CardConnectInterface
{

    public function __construct(
        private string $serviceUrl,
        private string $username,
        private string $password,
        private string $merchantID
    ) {
        parent::__construct($this->serviceUrl, $this->username, $this->password, $this->merchantID);
    }

    public function inquireMerchant(): CardPointe
    {
        return $this->request('GET', Endpoint::INQUIRE_MERCHANT->value . '/' . $this->merchantID);
    }

    public function authorization(array $parameters): CardPointe
    {
        return $this->request('POST', Endpoint::AUTHORIZATION->value, $parameters);
    }

    public function capture($parameters): CardPointe
    {
        return $this->request('POST', Endpoint::CAPTURE->value, $parameters);
    }

    public function void(array $parameters): CardPointe
    {
        return $this->request('POST', Endpoint::VOID->value, $parameters);
    }

    public function refund(array $parameters): CardPointe
    {
        return $this->request('POST', Endpoint::REFUND->value, $parameters);
    }

    public function inquire(string|int $retRef): CardPointe
    {
        return $this->request('GET', Endpoint::INQUIRE->value . '/' . $retRef . '/' . $this->merchantID);
    }

    public function inquireByOrderId(string|int $orderID, int|string $restrict = ''): CardPointe
    {
        return $this->request(
            'GET',
            Endpoint::INQUIRE_BY_ORDER_ID->value . '/' . $orderID . '/' . $this->merchantID . '/' . $restrict
        );
    }

    public function voidByOrderId(array $parameters): CardPointe
    {
        return $this->request('POST', Endpoint::VOID_BY_ORDER_ID->value, $parameters);
    }

    public function settlementStatus(string $date = '', string|int $batchId = ''): CardPointe
    {
        return $this->request('GET', Endpoint::SETTLEMENT_STATUS->value, [
            'date'    => $date,
            'batchid' => $batchId
        ]);
    }

    public function funding(string $date): CardPointe
    {
        return $this->request('GET', Endpoint::FUNDING->value, [
            'date' => $date,
        ]);
    }

    public function getProfile(array $parameters): CardPointe
    {
        return $this->request('GET', Endpoint::PROFILE->value, $parameters);
    }

    public function createProfile(array $parameters): CardPointe
    {
        return $this->request('POST', Endpoint::PROFILE->value, $parameters);
    }

    public function updateProfile(array $parameters): CardPointe
    {
        return $this->request('PUT', Endpoint::PROFILE->value, $parameters);
    }

    public function deleteProfile(array $parameters): CardPointe
    {
        return $this->request('DELETE', Endpoint::PROFILE->value, $parameters);
    }

    public function signatureCapture(array $parameters): CardPointe
    {
        return $this->request('POST', Endpoint::SIGNATURE_CAPTURE->value, $parameters);
    }

    public function bin(string $token): CardPointe
    {
        return $this->request('GET', Endpoint::BIN->value . '/' . $this->merchantID . '/' . $token);
    }

}