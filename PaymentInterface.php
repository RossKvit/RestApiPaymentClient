<?php

interface PaymentInterface{

    public function getEndpoint(): string;

    public function getMethod(): string;

    public function getBody(): array;

    public function getHeaders(): array;

    public function getCookies(): array;
}