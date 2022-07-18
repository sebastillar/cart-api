<?php

namespace App\Interfaces;

interface RepositoryHttpInterface
{
    public function requestHttp(array $headers, array $body): string;

    public function saveFromArray(array $models);
}
