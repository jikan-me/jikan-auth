<?php

namespace JikanAuth\Request;

use JikanAuth\Client\MalClient;

interface RequestInterface
{
    public function getPath(): string;
    public function createRequest(MalClient $client);
}