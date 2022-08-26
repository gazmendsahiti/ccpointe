<?php

declare(strict_types=1);

namespace gazmendsahiti\CcPointe;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use RuntimeException;

abstract class RequestManager
{

    private const GET = 'GET';
    private const POST = 'POST';
    private const PUT = 'PUT';
    private const DELETE = 'DELETE';

    private string $endpoint;
    private mixed $response;
    private array $options;

    use Helpers\ResponseParser;

    public function __construct(
        private string $serviceUrl,
        private readonly string $username,
        private readonly string $password,
        private readonly string $merchantId
    ) {
        $this->serviceUrl = str_ends_with($this->serviceUrl, '/') ? $this->serviceUrl : $this->serviceUrl . '/';
    }


    protected function request(string $httpMethod, string $endPoint, $parameters = []): self
    {
        if (!in_array($httpMethod, [self::GET, self::POST, self::PUT, self::DELETE])) {
            throw  new RuntimeException('Unknown HTTP method type: ' . $httpMethod);
        }
        try {
            $options = $this->setOptions($httpMethod, $this->serviceUrl . $endPoint, $parameters);
            $request = new Request($httpMethod, $options['service_url'], $options['headers'], $options['body']);

            $client = new Client([
                'verify' => false
            ]);

            $this->response = $client->sendAsync($request)->wait()->getBody()->getContents();

            return $this;
        } catch (BadResponseException $exception) {
            echo $exception->getMessage();
            die;
        }
    }

    private function setOptions(string $httpMethod, string $serviceUrl, $parameters): array
    {
        $options['body'] = '';

        $options['service_url'] = $serviceUrl;

        if (!str_contains($serviceUrl, $this->merchantId)) {
            $parameters['merchid'] = $this->merchantId;
        }

        if ($parameters !== [] && $httpMethod !== self::GET) {
            $options['body'] = json_encode($parameters);
        } else {
            $options['service_url'] = $serviceUrl . '?' . http_build_query($parameters);
        }

        $options['headers'] = [
            'Content-Type'  => 'application/json',
            'User-Agent'    => $_SERVER['HTTP_USER_AGENT'],
            'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password),
        ];
        return $options;
    }
}