<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class PayOp{

    private const JWT_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGcitest.eyJpZCI6ODA1OTcsImFjY2Vzc1Rva2VuIjoiNDZiNTIwNTEyMtestidG9rZW5JZCI6MjkyMSwid2FsbGV0SWQiOjcyNzM1LCJ0aW1ltestjE1NDU4LCJleHBpcmVkQXQiOjE2ODg1OTA4MDAsInJvbGVzIjpbMV0sInR3b0Zhtest';

    protected const URL = 'https://payop.com';

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param PaymentInterface $request
     * @return array
     * @throws Exception
     */
    public function sendRequest(PaymentInterface $request): array
    {
        try {
            $response = $this->request($request);

            $result = [];
            if($response) {
                $result = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            }
             return $result;

        } catch (Exception | GuzzleException $exception) {
            echo $exception->getMessage();
        }
        echo 'Request Error!';
    }

    /**
     * @param PaymentInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function request(PaymentInterface $request )
    {
        $result = null;
        try {
            $result = $this->client->request($request->getMethod(), $this->getUrl($request), [
                RequestOptions::JSON => $request->getBody(),
                RequestOptions::HEADERS => $this->addAuthHeader($request),
                RequestOptions::COOKIES => $request->getCookies(),
            ]);
        } catch (Exception | GuzzleException $exception) {
            echo $exception->getMessage();
        }
        return $result;
    }

    /**
     * @param PaymentInterface $request
     *
     * @return string
     */
    protected function getUrl(PaymentInterface $request): string
    {
        return self::URL . $request->getEndpoint();
    }

    /**
     * @param PaymentInterface $request
     * @return array
     */
    protected function addAuthHeader(PaymentInterface $request): array
    {
        $headers = $request->getHeaders();
        $headers[] = 'Authorization: Bearer '. self::JWT_TOKEN;
        return $headers;
    }

}
