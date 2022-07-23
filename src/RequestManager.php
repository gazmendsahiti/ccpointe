<?php

declare(strict_types=1);

namespace gazmendsahiti\CcPointe;

use Exception;
use GuzzleHttp\Client;
use RuntimeException;

abstract class RequestManager
{

    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const DELETE = 'DELETE';

    private object $client;
    private mixed $response;

    use Helpers\ResponseParser;

    public function __construct(
        private readonly string $serviceUrl,
        private readonly string $username,
        private readonly string $password,
        private readonly string $merchantId
    )
    {
        $this->setClient();
    }

    private function setClient(): void
    {
        $serviceUrl = str_ends_with($this->serviceUrl, '/') ? $this->serviceUrl : $this->serviceUrl . '/';
        $options = [
            'base_uri' => $serviceUrl,
            'allow_redirects' => false,
            'headers' => [
                'User-Agent' => 'PHP CardPointe v1.0',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password)
            ],
            'verify' => false
        ];
        $this->client = new Client($options);
    }

    protected function request(string $httpMethod, string $endPoint, array $parameters = []): self
    {
        if (!in_array($httpMethod, [self::GET, self::POST, self::PUT, self::DELETE])) {
            throw  new RuntimeException('Unknown HTTP method type: ' . $httpMethod);
        }
        try {
            $parameters['merchid'] = $this->merchantId;
            if ($httpMethod === self::GET) {
                $options['query'] = $parameters;
            } else {
                $options['form_params'] = $parameters;
            }
            $this->response = $this->client->request($httpMethod, $endPoint, $options)->getBody()->getContents();
            return $this;
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }

}